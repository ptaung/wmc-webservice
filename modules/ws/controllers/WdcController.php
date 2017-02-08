<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 * ระบบ Datacenter wmwebmanager
 */

namespace app\modules\ws\controllers;

use yii\helpers\ArrayHelper;
use yii\rest\Controller;
#use yii\filters\ContentNegotiator;
#use yii\web\Response;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use app\modules\ws\models\HospitalBaseStatus;

class WdcController extends Controller {

    public $logpath = "";
    public $log_sender = 'wmdc-working'; //Log filename sender
    public $log_process = 'wmdc-process'; //Log filename
    public $log_error = 'wmdc-error'; //Log filename
    public $log_filesize = 'wmdc-filesize'; //Log filename
    public $log_time = 'wmdc-time'; //Log filename
    public $modelClass = 'app\modules\report\models\WuseItems';

    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
                    'authenticator' => [
                        'class' => CompositeAuth::className(),
                        'authMethods' => [
                            ['class' => HttpBearerAuth::className()],
                            ['class' => QueryParamAuth::className(), 'tokenParam' => 'accessToken'],
                        ]
                    ],
                    'exceptionFilter' => [
                        'class' => ErrorToExceptionFilter::className()
                    ],
        ]);
    }

//ตรวจสอบการก่อนส่งข้อมูล
    public function actionChecking() {
        $data = json_decode(key(Yii::$app->request->post()), true);
        try {
            $db = Yii::$app->db;
//------clear sync per day
            $sql = "UPDATE hospital_base_status SET hbs_info = '' WHERE timestampdiff(DAY,hbs_sync_start,NOW()) > 0 AND hbs_hospital_id = '{$data['hcode']}' ;";
            $db->createCommand($sql)->execute();
            $checkQuery = "select if(hbs_info is null || hbs_info = '',1,0) as c from hospital_base_status where hbs_hospital_id = '{$data['hcode']}'  /*" . date('Y-m-d H:i:s') . "*/";
            $check = $db->createCommand($checkQuery)->queryOne();
#$this->writeLog($this->log_error, $checkQuery);
        } catch (\Exception $e) {
            $check = 0;
            $this->writeLog($this->log_error, $e->getMessage());
        }
        return ['response_client' => ['status' => ($check ? 'true' : 'false'), 'message' => 'success'], 'data' => ['errorCode' => '']];
    }

    public function actionError() {

        $data = json_decode(key(Yii::$app->request->post()), true);
        try {
            $online = HospitalBaseStatus::findOne($data['hcode']);
            $online->hbs_time = new \yii\db\Expression('NOW()');
            $online->hbs_ip = Yii::app()->request->userIP;
            $online->hbs_error = 1;
            $online->hbs_info = '';
            $online->hbs_browser = $data['error_message'];
            $online->save();
        } catch (\Exception $e) {
            $this->writeLog($this->log_error, $e->getMessage());
        }

        return ['response_client' => ['status' => 1, 'message' => 'success']];
    }

    public function actionOnline() {

        $data = Yii::$app->request->post();
        try {
            $result = yii::$app->db_datacenter->createCommand("SELECT hbs_hospital_id,hbs_sync,hbs_command FROM hospital_base_status WHERE hbs_hospital_id = '{$data['hcode']}' AND hbs_secretkey = '{$data['secretkey']}'")->queryOne();
            if ($result['hbs_hospital_id'] == $data['hcode']) {
                yii::$app->db_datacenter->createCommand()
                        ->update('hospital_base_status', [
                            'hbs_ip' => Yii::$app->request->userIP,
                            'hbs_browser' => $data['client'],
                            'hbs_version' => $data['version'],
                            'hbs_sync' => 0,
                            'hbs_command' => 0,
                            'hbs_db_version' => $data['dbversion'],
                            'hbs_upload_size' => @$data['log']['txtsize'],
                            'hbs_status_process' => @(($data['log']['process_current'] * 100) / $data['log']['process_all']),
                            'hbs_time' => new \yii\db\Expression('NOW()')
                                ], "hbs_hospital_id = '{$data['hcode']}'")
                        ->execute();
                return ['status' => 'success', 'message' => date('y-m-d H:i:s'), 'sync' => $result['hbs_sync'], 'dlc' => $result['hbs_command']];
            } else {
                return ['status' => 'error', 'message' => 'NOT FOUND hcode or secretkey not correct', 'sync' => 0];
            }
        } catch (\Exception $exc) {
            return ['status' => 'error', 'message' => $exc->getMessage()];
        }
    }

    /**
     * DataLink-Command
     * * */
    public function actionDlc() {
        $data = Yii::$app->request->post();

        if (isset($data['report'])) {
            yii::$app->db_datacenter->createCommand()
                    ->update('wmc_tranfer_command', [
                        'command_message' => $data['report']['command_message'],
                        'command_status' => $data['report']['command_status'],
                        'processtime' => $data['report']['processtime']
                            ], "wtc_id = '{$data['report']['wtc_id']}'")
                    ->execute();
            return ['status' => 'success', 'data' => ['wtc_id' => $data['report']['wtc_id']]];
        } else {



            $sqlString = "SELECT wtc_id,hospcode,sqlquery
                        FROM wmc_tranfer_command
                        WHERE hospcode = '{$data['hcode']}'
                        AND command_status IN ('wait','error')
                        AND confirmtime <= NOW()
                        AND confirmtime IS NOT NULL
                        AND sqlquery IS NOT NULL
                        AND sqlquery <> ''
                        AND wtc_active = 1";

            try {
                $result = Yii::$app->db_datacenter->createCommand($sqlString)->queryAll();
            } catch (\Exception $e) {

            }
            return ['status' => 'success', 'data' => $result];
        }
    }

    public function actionFlags() {
        $data = Yii::$app->request->post();
        switch ($data['status']) {
            case 1:
                $sqlQuery = "UPDATE hospital_base_status SET hbs_ip = '{$_SERVER['REMOTE_ADDR']}',hbs_sync_start = NOW(),hbs_time = NOW(),hbs_info = 'START-PROCESS',hbs_status_process = 0 WHERE hbs_hospital_id = '{$data['hcode']}';";
                break;
            case 2:
                $sqlQuery = "UPDATE hospital_base_status SET hbs_status_process = '{$data['process']}',hbs_time = NOW(),hbs_info = 'CHECKSUM-DATA' WHERE hbs_hospital_id = {$data['hcode']};";
                break;
            case 3:
                $sqlQuery = "UPDATE hospital_base_status SET hbs_sync_start = NOW(),hbs_time = NOW(),hbs_info = 'UPLOAD-DATA',hbs_status_process = '{$data['process']}' WHERE hbs_hospital_id = '{$data['hcode']}';";
                break;
            case 4:
                $sqlQuery = "UPDATE hospital_base_status SET hbs_ip = '{$_SERVER['REMOTE_ADDR']}',hbs_sync_finish = NOW(),hbs_info = 'FINISH-PROCESS' WHERE hbs_hospital_id = '{$data['hcode']}';";
                break;
            default:
                break;
        }
        try {
            yii::$app->db_datacenter->createCommand($sqlQuery)->execute();
        } catch (\Exception $e) {
            $this->writeLog($this->log_error . '-' . $data['hcode'], $e->getMessage());
        }
        return ['status' => 'success', 'message' => date('y-m-d H:i:s')];
    }

    public function actionProcess() {
        $filepath = dirname(@app) . '/log/u/';
        if (!is_dir($filepath))
            @mkdir($filepath);
        $queryData = @file_get_contents($filepath . $data['filename'] . '.txt', FILE_USE_INCLUDE_PATH);
    }

//ส่งข้อมูลจาก Client
    public function actionUpload() {
        $data = Yii::$app->request->post();
        $filedata = $data['filename'];

        try {
            $filepath = dirname(@app) . '/log/u/';
            if (!is_dir($filepath))
                @mkdir($filepath);

            if (!empty($_FILES["zipFile"])) {
                $zipFile = $_FILES["zipFile"];
                $success = move_uploaded_file($zipFile["tmp_name"], $filepath . $zipFile["name"]);
                if ($success) {
                    $zip = new \ZipArchive;
                    if ($zip->open($filepath . $data['filename'] . '.zip') === TRUE) {
                        $zip->extractTo($filepath);
                        $zip->close();
                    }
                    @unlink($filepath . $data['filename'] . '.zip');
                    return ['status' => 'success', 'message' => date('Y-m-d H:i:s'), 'data' => $zipFile];
                } else {
                    return ['status' => 'upload error', 'message' => date('Y-m-d H:i:s'), 'data' => $zipFile];
                }
            }
#-----------------------------------------------------------------------------
            #$queryData = @file_get_contents($filepath . $data['filename'] . '.txt', FILE_USE_INCLUDE_PATH);
            /*
              if (!empty($queryData)) {
              $queryData = "INSERT DELAYED IGNORE INTO " . str_replace('WM:CLIENT', 'dw_' . $data['hcode'], $queryData);
              $connection = Yii::$app->db_datacenter;
              #$transaction = $connection->beginTransaction();
              $connection->createCommand("START TRANSACTION;")->execute();
              $connection->createCommand($queryData)->execute();
              $connection->createCommand("COMMIT;")->execute();
              #$connection->createCommand("OPTIMIZE TABLE $table;")->execute();
              #$transaction->commit();
              }
             */
            #@unlink($filepath . $data['filename'] . '.txt');
        } catch (\Exception $e) {
            $this->writeLog($this->log_error . "-" . $data['hcode'], $e->getMessage());
        }
        @unlink($filepath . $data['filename'] . '.zip');

        return ['status' => 'success', 'message' => date('Y-m-d H:i:s')];
    }

    public function acctionChecksum() {
        $data = json_decode(key(Yii::$app->request->post()), true);
//load โครงสร้างตารางจาก Server
        $str_server = $this->getTableSynclist(array('hcode' => 'this', 'table' => $data['table']));
        $node = 'dw_' . $data['hcode'];
        $arr = array();

        foreach ($str_server as $row) {
            $describe = array();
            try {
                $result = Yii::$app->db_datacenter->createCommand("describe {$node}.{$row['ts']} /*" . date('Y-m-d H:i:s') . "*/;")->queryAll();
                foreach ($result as $a => $b) {
                    $describe[] = $b['Field'];
                }
            } catch (\Exception $e) {
                $this->writeLog($this->log_error . '-' . $node, $e->getMessage());
                continue;
            }

            $column = '';
            $fieldName = explode(',', $row['fs']);
            foreach ($fieldName as $field) {
                if (in_array($field, $describe))
                    $column.= ' CAST(ifnull(' . $field . ",'') AS CHAR),";
            }
            $column = rtrim($column, ", ");

            if (count($fieldName) > 1)
                $column = "concat_ws({$column})";

            $checkSumQuery = "select sum(crc32(convert({$column} USING utf8))) as cc from {$node}.{$row['ts']} /*" . date('Y-m-d H:i') . " */;";
            try {
                $checkSum = Yii::$app->db_datacenter->createCommand($checkSumQuery)->one();
            } catch (Exception $e) {
                $this->writeLog($this->log_error . '-' . $node, $e->getMessage());
                continue;
            }
            $arr[$row['ts']] = $checkSum;
        }

        $response = base64_encode(serialize($arr));
        return ['response_client' => $response];
    }

    /*
     * รับ Query มี run
     *
     */

    public function actionExecute() {
        $data = Yii::$app->request->post();
        $success = 0;
        $error = 0;
        foreach ($data['queryStaring'] as $query) {
            try {
                $response = Yii::$app->db_datacenter->createCommand($query)->execute();
                $success++;
                $this->createDescTable($data); #สร้างตาราง xdesc_tables ในแต่และฐานข้อมูล
            } catch (\Exception $e) {
                $error++;
                $this->writeLog($this->log_error . "-" . $data['hcode'], $e->getMessage());
                continue;
            }
        }
        return ['name' => 'execute', 'status' => 'success', 'message' => "Execute : success = $success || error = $error"];
    }

    public function actionCalldataserver() {
        $data = Yii::$app->request->post();
        try {
            $data = Yii::$app->db_datacenter->createCommand($data['query'])->queryAll();
            $return = ['name' => 'Calldataserver', 'status' => 'success', 'message' => 'Calldataserver', 'data' => ['rows' => $data, 'numrow' => count($data)]];
        } catch (\Exception $exc) {
#$this->writeLog($this->log_error . '-' . $data['hcode'], $exc->getMessage());
            $this->writeLog($this->log_error . '-', $exc->getMessage());
            $return = ['name' => 'Calldataserver', 'status' => 'error', 'message' => $exc->getMessage()];
        }
        return $return;
    }

    public function actionQuery() {
        $data = json_decode(key(Yii::$app->request->post()), true);
        $query = base64_decode($data['query']);
        $query = str_replace('DBXXX', 'dw_' . $data['hcode'] . '.', $query);
        $this->writeLog($this->log_error . "-" . $data['hcode'], print_r(Yii::$app->request->post(), true));
        try {
            $response = Yii::$app->db_datacenter->createCommand($query)->queryAll();
            $response = base64_encode(serialize($response));
        } catch (\Exception $e) {
            $this->writeLog($this->log_error . "-" . $data['hcode'], $e->getMessage());
        }
        return ['response_client' => $response];
    }

    public function actionCreatetablesync() {
        $data = Yii::$app->request->post();
        $node = 'dw_' . $data['hcode'];
        $res = [];
        $array = [];
        try {
            $result = Yii::$app->db_datacenter->createCommand($data['queryStaring'])->execute();
        } catch (\Exception $e) {

        }
        return ['response_client' => ['status' => $res, 'data' => $array]];
    }

    public function actionChecktable() {
        $data = json_decode(key(Yii::$app->request->post()), true);
        $node = 'dw_' . $data['hcode'];
        $res = [];
        $array = [];
        try {
            $sql = "SELECT TABLE_SCHEMA,TABLE_NAME,COLUMN_NAME FROM Information_schema.COLUMNS WHERE table_schema = '{$node}' /*" . date('Y-m-d H:i:s') . "*/ ;";
            $result = Yii::$app->db_datacenter->createCommand($sql)->queryAll();
            foreach ($result as $key => $rows) {
                $array[$rows['TABLE_NAME']][] = $rows['COLUMN_NAME'];
            }
            $res['status'] = "true";
            $res['message'] = "success";
        } catch (\Exception $e) {
            $res['status'] = "false";
            $res['message'] = $e->getMessage();
        }
        return ['response_client' => ['status' => $res, 'data' => $array]];
    }

    /*
     * ข้อมูล Getsqlquerystring
     *
     */

    public function actionGetsqlquerystring() {
        $data = Yii::$app->request->post();
        $tableSyncData = [];
        $dbname = 'dw_' . $data['hcode'];
        foreach ($data['tableSyncData'] as $key => $row) {
#-------------------------------------------------------------------
            $query = '';
            switch ($row['sm']) {
                case 1://ตรวจสอบตามวันที่ในรูป DATE()
                    $query = "select IF({$row['p1']} IS NULL || {$row['p1']} = '0000-00-00','0000-00-00'"
                            . ",{$row['p1']}) AS dd ,count(*) as cc "
                            . ",{$row['checksum']} "
                            . " from {$dbname}.{$row['ts']} " #WHERE YEAR({$row['p1']}) BETWEEN YEAR(NOW())-5 AND YEAR(NOW())
                            . " group by date({$row['p1']}) desc " . ' /*' . date('Y-m-d H') . ' */;';
                    break;
//DBXXX หมายถึง ชื่อฐานข้อมูล
                case 2: //ตรวจสอบข้อมูลทั้งหมดที่มี
                    $query = "select '{$row['ts']}' as dd,count(*) as cc,'' as ss from {$dbname}.{$row['ts']}" . ' /*' . date('Y-m-d H') . ' */;';
                    break;
                case 3: //ตรวจสอบตามรหัส an,vn โดยใช้ LEFT(,6)
                    $query = "select IF(LEFT({$row['p1']},6) IS NULL || LEFT({$row['p1']},6) = '','000000'"
                            . ",LEFT({$row['p1']},6)) AS dd,count(*) as cc "
                            . ",{$row['checksum']} "
                            . " from {$dbname}.{$row['ts']} "
                            . " group by LEFT({$row['p1']},6)  desc " . ' /*' . date('Y-m-d H') . ' */;';
                    break;
//DBXXX หมายถึง ชื่อฐานข้อมูล
                case 4: //ตรวจสอบตามการจัดกลุ่มข้อมูลที่เป็น PK ของลำดับตัวเลข
                    $query = "select concat(min({$row['p1']}),'|',max({$row['p1']})) as dd"
                            . ",count(*) as cc"
                            . ",{$row['checksum']} "
                            . " from {$dbname}.{$row['ts']}"
                            . " group by (CONVERT({$row['p1']},UNSIGNED INTEGER) DIV 1000) desc" . ' /*' . date('Y-m-d H') . ' */;';
                    break;
            }

#-------------------------------------------------------------------
            $tableSyncData[$row['ts']]['query'] = $query;
        }
        return ['name' => 'getsqlquerystring', 'status' => 'success', 'message' => 'Desc data', 'data' => ['rows' => $tableSyncData, 'numrow' => count($tableSyncData)]];
    }

    /*
     * ข้อมูล Column From dw_xxxxx.xdesc_tables
     * กรณีที่มีการเพิ่มตาราง จะมีปัญหาเรื่อง Cache table
     */

    public function actionDesc() {
        $data = Yii::$app->request->post();
        try {
            $response = Yii::$app->db_datacenter->createCommand("SELECT  table_name,column_name FROM dw_{$data['hcode']}.xdesc_tables;")->queryAll();
            foreach ($response as $key => $value) {
                $data[$value['table_name']][] = $value['column_name'];
            }
            $return = ['name' => 'Desc', 'status' => 'success', 'message' => 'Desc data', 'data' => ['rows' => $data, 'numrow' => count($data)]];
        } catch (\Exception $exc) {
            $this->writeLog($this->log_error . '-' . $data['hcode'], $exc->getMessage());
            $return = ['name' => 'Desc', 'status' => 'error', 'message' => $exc->getMessage()];
        }
        return $return;
    }

    public function createDescTable($data = []) {
        $sqlCreateDescTable = "DROP TABLES IF EXISTS dw_{$data['hcode']}.xdesc_tables;
          CREATE TABLE dw_{$data['hcode']}.xdesc_tables (
	  `table_schema` VARCHAR(100) NOT NULL DEFAULT '',
	  `table_name` VARCHAR(100) NOT NULL DEFAULT '',
	  `column_name` VARCHAR(100) NOT NULL DEFAULT '',
	  `column_key` VARCHAR(3) NOT NULL DEFAULT '',
	  KEY `table_schema` (`table_schema`),
	  KEY `table_name` (`table_name`),
	  KEY `column_name` (`column_name`),
	  KEY `column_key` (`column_key`)
	) ENGINE=MYISAM DEFAULT CHARSET=utf8;

        INSERT INTO dw_{$data['hcode']}.xdesc_tables (SELECT table_schema,table_name,column_name,column_key FROM information_schema.columns WHERE table_schema = 'dw_{$data['hcode']}');";

        try {
            $result = Yii::$app->db->createCommand($sqlCreateDescTable)->execute();
        } catch (\Exception $exc) {
            $this->writeLog($this->log_error . '-' . $data['hcode'], $exc->getMessage());
        }
    }

    /*
     * ตรวจสอบฐานข้อมูล
     *
     */

    public function actionChecknode() {
        $data = Yii::$app->request->post();
        $return = [];
        try {
            $node = 'dw_' . $data['hcode'];
            $sql = "create database if not exists {$node};";
            $sql .= "create table if not exists {$node}.wm_table_sync_list (primary key (wm_table_sync_name)) select * from wm_table_sync_list;";
            $sql .= "INSERT ignore into {$node}.wm_table_sync_list SELECT * FROM wm_table_sync_list;";
            $message = Yii::$app->db->createCommand($sql)->execute();
            $return = ['name' => 'checkNode', 'status' => 'success', 'message' => $message];
        } catch (\Exception $exc) {
            $return = ['name' => 'checkNode', 'status' => 'error', 'message' => $exc->getMessage()];
            $this->writeLog($this->log_error . '-' . $data['hcode'], $exc->getMessage());
        }
        return $return;
    }

    /*
     * แสดงรายการตารางที่ต้องการ Sync
     */

    public function actionGetsynclist() {
        $data = Yii::$app->request->post();
        $tablesSync = '';
        $synctype = '';
        if (isset($data['table']) && is_array($data['table']) && count($data['table']) > 0) {
            $arr = $data['table'];
            $lookup = '';
            foreach ($arr as $v) {
                $lookup .= "'{$v}',";
            }
            $lookup = rtrim($lookup, ',');
            $tablesSync = " AND a2.wm_table_sync_name in ({$lookup})";
        } else {
            switch ($data['synctype']) {
                case 1:#service
                    $synctype = " AND a2.sync_type_id IN (1,3) ";
                    break;
                case 2:#basic
                    $synctype = " AND a2.sync_type_id IN (2,4) ";
                    break;
                default:
                    $synctype = '';
                    break;
            }
        }

        if (isset($data['hcode'])) {
            if ($data['hcode'] == 'this')
                $dbname = '';
            else
                $dbname = 'dw_' . $data['hcode'];
        }

        try {
            $sqlQuery = "SELECT
                            if( t.table_name is null, 0,1) AS ny,
                            '0' as rw,
                            a2.wm_table_sync_name as ts,
                            a2.param1 as p1,
                            #a2.param2 as p2,
                            #a2.param3 as p3,
                            #a2.min_date,
                            a2.sync_type_id as sm,
                            a2.active as ac,
                            if(a1.update_time='0000-00-00 00:00:00','',a1.update_time) as ut,
                            if(a1.sync_time='0000-00-00 00:00:00','',a1.sync_time) as st,
                            a1.n_server as ns,
                            a1.n_client as nc,
                            #a1.checksum as cm,
                            if(a1.n_server <> a1.n_client,0,a1.checksum) as cm,
                            ifnull(a2.sync_field_name,'*') as fs
                            FROM {$dbname}.wm_table_sync_list a1
                            LEFT JOIN  wm_table_sync_list a2  ON a1.wm_table_sync_name = a2.wm_table_sync_name
                            LEFT JOIN Information_schema.tables t ON t.table_name = a2.wm_table_sync_name AND t.table_schema = '{$dbname}'
                            WHERE a2.active = 'Y' {$tablesSync} {$synctype}
                            ORDER BY a2.wm_table_sync_name ASC
                            /*" . date('Y-m-d H') . "*/
            ";
            $data = Yii::$app->db->createCommand($sqlQuery)->queryAll();
            $return = ['name' => 'getsynclist', 'status' => 'success', 'message' => 'getsynclist data', 'data' => ['rows' => $data, 'numrow' => count($data)]];
        } catch (\Exception $exc) {
            $return = ['name' => 'getsynclist', 'status' => 'error', 'message' => $exc->getMessage()];
        }

        return $return;
    }

    public function actionCleardata() {
        $data = json_decode(key(Yii::$app->request->post()), true);

        $this->writeLog($this->log_error . '-clearData-test', key(Yii::$app->request->post()));

        try {
            $query = base64_decode($data['query']);
            $sql = "delete ignore from dw_{$data['hcode']}.{$query} ;";
            $response = Yii::$app->db_datacenter->createCommand($sql)->execute();
        } catch (\Exception $e) {
            $this->writeLog($this->log_error . '-clearData-' . $data['hcode'], $e->getMessage());
        }
        return['response' => ['status' => 1, 'message' => 'success']];
    }

    public function auth($username, $password) {
//Authen form table
        return HospitalBaseStatus::findOne(['hbs_hospital_id' => $username, 'hbs_secretkey' => $password]);
    }

    public function writeLog($prefix, $text = '', $special = '', $addDate = 'Y') {
#if (!isset($this->logpath))
        $logpath = dirname(@app) . '/log/'; //กำหนดค่า path ของ Log
        if (empty($prefix))
            $this->wm_exception('log');
        if ($addDate == 'Y') {
            $log = date("Y-m-d H:i:s") . " | {$text} \n";
        } else {
            $log = $text;
        }
        $addDate = 'N';

        if (!is_dir($logpath))
            mkdir($logpath);
        $logfilename = $logpath . $prefix . ($addDate == 'Y' ? "_" . date("Y-m- d") :
                        '') . '.txt';
        $this->write_logFile($logfilename, ($special == '' ? 'a' : $special), $log);
    }

    public function write_logFile($strFileName, $option, $text) {
        $objFopen = @fopen($strFileName, $option);
        @fwrite($objFopen, $text);
        @fclose($objFopen);
    }

}
