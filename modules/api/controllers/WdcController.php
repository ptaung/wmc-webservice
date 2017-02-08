<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 * ระบบ Datacenter wmwebmanager
 */

namespace app\modules\api\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii;
use app\modules\wmservice\models\HospitalBaseStatus;

class WdcController extends ActiveController {

    public $logpath = "";
    public $log_sender = 'wmdc-working'; //Log filename sender
    public $log_process = 'wmdc-process'; //Log filename
    public $log_error = 'wmdc-error'; //Log filename
    public $log_filesize = 'wmdc-filesize'; //Log filename
    public $log_time = 'wmdc-time'; //Log filename
    public $modelClass = 'app\modules\report\models\WuseItems';

    public function behaviors() {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth']
        ];

        $behaviors['bootstrap'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
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
            #$online->hbs_ip = Yii::app()->request->getUserHostAddress();
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
        $data = json_decode(key(Yii::$app->request->post()), true);
        $online = HospitalBaseStatus::findOne($data['hcode']);
        $online->hbs_time = new \yii\db\Expression('NOW()');
        #$online->hbs_ip = Yii::app()->request->getUserHostAddress();
        $online->hbs_version = $data['version'];
        $online->hbs_sync = 0;
        $online->hbs_update = 0;
        $online->save();
        return ['response_client' => ['status' => 1, 'message' => 'success', 'callsync' => $online->hbs_sync, 'callupdate' => $online->hbs_update, 'callfunc' => $online->hbs_command]];
    }

    public function actionFlags() {
        $data = json_decode(key(Yii::$app->request->post()), true);
        switch ($data['flag']['mode']) {
            case 'start':
                $sqlQuery = "UPDATE hospital_base_status set hbs_ip = '{$_SERVER['REMOTE_ADDR']}',hbs_sync_start = NOW(),hbs_time = NOW(),hbs_info = '{$data['flag']['signature']}',hbs_status_process = 0 where hbs_hospital_id = '{$data['hcode']}';";
                break;
            case 'process':
                $sqlQuery = "UPDATE dw_{$data['hcode']}.wm_table_sync_list SET sync_time = NOW() ,n_server = (SELECT count(*) FROM "
                        . "dw_{$data['hcode']}.{$data['flag']['table']}) ,n_client = " . (double) $data['flag']['n_client'] . ($data['flag']['n_client'] > 0 ? ",checksum = '{$data['flag']['checksum']}'" : '') . " WHERE wm_table_sync_name = '{$data['flag']['table']}' ;";
                $sqlQuery .= "UPDATE hospital_base_status set hbs_status_process = '{$data['flag']['process']}',hbs_time = NOW(),hbs_info = '" . md5($data['hcode']) . "' where hbs_hospital_id = '{$data['hcode']}';";
                break;
            case 'finish':
                $sqlQuery = "UPDATE hospital_base_status set hbs_ip = '{$_SERVER['REMOTE_ADDR']}',hbs_sync_finish = NOW(),hbs_info = '' where hbs_hospital_id = '{$data['hcode']}';";
                break;
            default:
                break;
        }
        try {
            $db = Yii::$app->db;
            $db->createCommand($sqlQuery)->execute();
        } catch (\Exception $e) {
            $this->writeLog($this->log_error . '-' . $data['hcode'], $e->getMessage());
        }
        return ['response_client' => ['status' => 'true', 'message' => 'success']];
    }

//ส่งข้อมูลจาก Client
    public function actionUpload() {
        $data = json_decode(key(Yii::$app->request->post()), true);
        $filedata = base64_decode($data['data']);

        try {
            $filepath = dirname(Yii::app()->basePath) . '/log/u/';
            if (!is_dir($filepath))
                @mkdir($filepath);
            @file_put_contents($filepath . $data['filename'] . '.zip', $filedata);
            $zip = new \ZipArchive;
            if ($zip->open($filepath . $data['filename'] . '.zip') === TRUE) {
                $zip->extractTo($filepath);
                $zip->close();
            }
            $queryData = @file_get_contents($filepath . $data['filename'] . '.txt', FILE_USE_INCLUDE_PATH);
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
            @unlink($filepath . $data['filename'] . '.txt');
        } catch (\Exception $e) {
            $this->writeLog($this->log_error . "-" . $data['hcode'], $e->getMessage());
        }
        @unlink($filepath . $data['filename'] . '.zip');
        return ['response_client' => ['status' => 'true', 'message' => 'success']];
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

    public function actionExecute() {
        $data = json_decode(key(Yii::$app->request->post()), true);
        $data = @unserialize(base64_decode($data['query']));
        foreach ($data as $query) {
            try {
                $response = Yii::$app->db_datacenter->createCommand($query)->execute();
            } catch (\Exception $e) {
                $this->writeLog($this->log_error, $e->getMessage());
                continue;
            }
        }
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

    public function actionDesc() {
        $data = json_decode(key(Yii::$app->request->post()), true);
        try {
            $response = Yii::$app->db_datacenter->createCommand("describe " . 'dw_' . $data['hcode'] . '.' . $data['table'] . " /*" . date('Y-m-d H:i:s') . "*/;")->queryAll();
            foreach ($response as $key => $value) {
                $data[] = $value['Field'];
            }
            $response = base64_encode(serialize($data));
        } catch (\Exception $e) {
            $this->writeLog($this->log_error . '-' . $data['hcode'], $e->getMessage());
        }
        return ['response_client' => $response];
    }

    public function actionChecknode() {
        $data = json_decode(key(Yii::$app->request->post()), true);
        try {
            $node = 'dw_' . $data['hcode'];
            $res = [];
            $sql = "create database if not exists {$node};";
            $sql .= "create table if not exists {$node}.wm_table_sync_list (primary key (wm_table_sync_name)) select * from wm_table_sync_list;";
            $sql .= "INSERT ignore into {$node}.wm_table_sync_list SELECT * FROM wm_table_sync_list;";
            Yii::$app->db_datacenter->createCommand($sql)->execute();
            $res['status'] = "true";
            $res['message'] = "success";
        } catch (\Exception $e) {
            $res['status'] = "false";
            $res['message'] = $e->getMessage();
            $this->writeLog($this->log_error . '-' . $data['hcode'], $e->getMessage());
        }
        return ['response_client' => $res];
    }

    public function actionSynclist() {
        $data = json_decode(key(Yii::$app->request->post()), true);
        $tablesSync = '';
        if (isset($data['table']) && !empty($data['table'])) {
            $arr = explode(',', $data['table']);
            $lookup = '';
            foreach ($arr as $v) {
                $lookup .= "'{$v}',";
            }
            $lookup = rtrim($lookup, ',');
            $tablesSync = " and a2.wm_table_sync_name in ({$lookup})";
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
                            WHERE a2.active = 'Y' {$tablesSync}
                            ORDER BY a2.wm_table_sync_name ASC
                            /*" . date('Y-m-d H:i:s') . "*/
            ";
            $return = Yii::$app->db_datacenter->createCommand($sqlQuery)->queryAll();
        } catch (\Exception $exc) {
            $return = [];
            $this->writeLog($this->log_error . '-' . $data['hcode'], $exc->getMessage());
        }

        return ['response_client' => $return];
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
        return['response_client' => ['status' => 1, 'message' => 'success']];
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
