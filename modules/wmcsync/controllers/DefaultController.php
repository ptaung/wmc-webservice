<?php

namespace app\modules\wmcsync\controllers;

use yii\helpers\FileHelper;
use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;

class DefaultController extends Controller {

    public function actionIndex() {
        $query = "SELECT *,
            IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,1,0) AS connect
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,1,0) AS realtime
                ,CONCAT(IF(TIMESTAMPDIFF(DAY,hbs_sync_start,hbs_sync_finish) <> 0,CONCAT(TIMESTAMPDIFF(DAY,hbs_sync_start,hbs_sync_finish),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(HOUR,hbs_sync_start,hbs_sync_finish), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(HOUR,hbs_sync_start,hbs_sync_finish), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(MINUTE,hbs_sync_start,hbs_sync_finish), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(MINUTE,hbs_sync_start,hbs_sync_finish), 60),' นาที '),'')
                ) AS usetime
                ,CONCAT(IF(TIMESTAMPDIFF(DAY,NOW(),hbs_sync_start) <> 0,CONCAT(TIMESTAMPDIFF(DAY,NOW(),hbs_sync_start),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_sync_start), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_sync_start), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_sync_start), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_sync_start), 60),' นาที '),'')
                ) AS synctime
                ,CONCAT(IF(TIMESTAMPDIFF(DAY,NOW(),hbs_sync_finish) <> 0,CONCAT(TIMESTAMPDIFF(DAY,NOW(),hbs_sync_finish),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_sync_finish), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_sync_finish), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_sync_finish), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_sync_finish), 60),' นาที '),'')
                ) AS lastsync
                ,CONCAT(IF(TIMESTAMPDIFF(DAY,NOW(),hbs_time) <> 0,CONCAT(TIMESTAMPDIFF(DAY,NOW(),hbs_time),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_time), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_time), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_time), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_time), 60),' นาที '),'')
                ) AS lastonline

            FROM hospital_base_status ORDER BY connect DESC,hbs_hospital_id ASC";
        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 500,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        } return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /*
     * นับจำนวนไฟล์
     */

    public function actionCountfile() {
        $filepath = Yii::getAlias('@app') . "/web/log/u/";
        $file = FileHelper::findFiles($filepath, ['only' => ['*.txt'], 'except' => ['importprocess.txt'], 'recursive' => false]);
        echo count($file);
    }

    public function actionImport() {
        $query = "SELECT * FROM wmc_import ORDER BY starttime DESC";
        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                ],
                'pagination' => [
                    'pageSize' => 500,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        } return $this->renderAjax('import', ['dataProvider' => $dataProvider]);
    }

    public function actionSync() {
        $post = yii::$app->request->post();
        $id = $post['id'];
        $sync = $$post['sync'];

        yii::$app->db_datacenter->createCommand()->update('hospital_base_status', ['hbs_sync' => ($sync == 1 ? 0 : 1)], ['hbs_hospital_id' => $id])->execute();
        echo 'SUCCESS COMMAND';
    }

    public function actionDlc() {
        $post = yii::$app->request->post();
        $id = $post['id'];
        $sync = $$post['dlc'];

        yii::$app->db_datacenter->createCommand()->update('hospital_base_status', ['hbs_command' => ($sync == 1 ? 0 : 1)], ['hbs_hospital_id' => $id])->execute();
        echo 'SUCCESS COMMAND';
    }

    public function actionGetsyncstauts() {
        $hospcode = \Yii::$app->user->identity->profile->hospcode;
        $sql = "SELECT hospital_base_status.*
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_sync_start)) <= 150 AND hbs_sync_start != '0000-00-00 00:00:00',1,0) AS syncing
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,1,0) AS connect
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,1,0) AS realtime
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,'ONLINE','OFFLINE') AS online
                # 24 ชั่วโมง
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= (60*60*24),1,0) AS status_online
                # 2 วัน
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= (60*60*24*3),1,0) AS status_sync
                ,CONCAT(hoscode,' ',hosname) AS fullname
                ,CONCAT(IF(TIMESTAMPDIFF(DAY,hbs_sync_start,hbs_sync_finish) <> 0,CONCAT(TIMESTAMPDIFF(DAY,hbs_sync_start,hbs_sync_finish),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(HOUR,hbs_sync_start,hbs_sync_finish), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(HOUR,hbs_sync_start,hbs_sync_finish), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(MINUTE,hbs_sync_start,hbs_sync_finish), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(MINUTE,hbs_sync_start,hbs_sync_finish), 60),' นาที '),'')
                ) AS usetime
                ,CONCAT(IF(TIMESTAMPDIFF(DAY,NOW(),hbs_sync_start) <> 0,CONCAT(TIMESTAMPDIFF(DAY,NOW(),hbs_sync_start),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_sync_start), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_sync_start), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_sync_start), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_sync_start), 60),' นาที '),'')
                ) AS synctime
                ,CONCAT(IF(TIMESTAMPDIFF(DAY,NOW(),hbs_sync_finish) <> 0,CONCAT(TIMESTAMPDIFF(DAY,NOW(),hbs_sync_finish),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_sync_finish), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_sync_finish), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_sync_finish), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_sync_finish), 60),' นาที '),'')
                ) AS lastsync
                ,CONCAT(IF(TIMESTAMPDIFF(DAY,NOW(),hbs_time) <> 0,CONCAT(TIMESTAMPDIFF(DAY,NOW(),hbs_time),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_time), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(HOUR,NOW(),hbs_time), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_time), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(MINUTE,NOW(),hbs_time), 60),' นาที '),'')
                ) AS lastonline

                FROM hospital_base_status,chospital
                WHERE hbs_hospital_id = hoscode AND hbs_hospital_id = '{$hospcode}'
";

        try {
            $data = Yii::$app->db_datacenter->createCommand($sql)->queryAll();
        } catch (\Exception $exc) {
            $data = [];
        }

        $jdata = [];
        foreach ($data as $key => $rows) {
            $jdata['hospcode'] = $hospcode;
            $jdata['online'] = $rows['online'];
            $jdata['lastonline'] = $rows['lastonline'];
            $jdata['ip'] = $rows['hbs_ip'];
            $jdata['lastsync'] = $rows['lastsync'];
            #$jdata['checksync'] = $rows['status_online'];
        }

        echo json_encode($jdata);
    }

}
