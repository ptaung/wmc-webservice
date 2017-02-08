<?php

namespace app\modules\wmservice\controllers;

use Yii;
use app\modules\wmservice\models\HospitalBaseStatus;
use app\modules\wmservice\models\HospitalBaseStatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * HospitalbasestatusController implements the CRUD actions for HospitalBaseStatus model.
 */
class HospitalbasestatusController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all HospitalBaseStatus models.
     * @return mixed
     */
    public function actionIndex() {

        $query = "SELECT hospital_base_status.*
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_sync_start)) <= 150 AND hbs_sync_start != '0000-00-00 00:00:00',1,0) AS syncing
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,1,0) AS connect
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,1,0) AS realtime
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,'ONLINE','OFFLINE') AS online
                # 24 ชั่วโมง
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= (60*60*24),1,0) AS status_online
                # 2 วัน
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= (60*60*24*3),1,0) AS status_sync


                ,CONCAT(hoscode,' ',hosname) as fullname

                ,CONCAT(IF(TIMESTAMPDIFF(day,hbs_sync_start,hbs_sync_finish) <> 0,CONCAT(TIMESTAMPDIFF(day,hbs_sync_start,hbs_sync_finish),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(hour,hbs_sync_start,hbs_sync_finish), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(hour,hbs_sync_start,hbs_sync_finish), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(minute,hbs_sync_start,hbs_sync_finish), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(minute,hbs_sync_start,hbs_sync_finish), 60),' นาที '),'')
                ) as usetime

                ,CONCAT(IF(TIMESTAMPDIFF(day,NOW(),hbs_sync_start) <> 0,CONCAT(TIMESTAMPDIFF(day,NOW(),hbs_sync_start),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(hour,NOW(),hbs_sync_start), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(hour,NOW(),hbs_sync_start), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(minute,NOW(),hbs_sync_start), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(minute,NOW(),hbs_sync_start), 60),' นาที '),'')
                ) as synctime

                ,CONCAT(IF(TIMESTAMPDIFF(day,NOW(),hbs_sync_finish) <> 0,CONCAT(TIMESTAMPDIFF(day,NOW(),hbs_sync_finish),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(hour,NOW(),hbs_sync_finish), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(hour,NOW(),hbs_sync_finish), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(minute,NOW(),hbs_sync_finish), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(minute,NOW(),hbs_sync_finish), 60),' นาที '),'')
                ) as lastsync

                ,CONCAT(IF(TIMESTAMPDIFF(day,NOW(),hbs_time) <> 0,CONCAT(TIMESTAMPDIFF(day,NOW(),hbs_time),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(hour,NOW(),hbs_time), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(hour,NOW(),hbs_time), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(minute,NOW(),hbs_time), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(minute,NOW(),hbs_time), 60),' นาที '),'')
                ) as lastonline

                FROM hospital_base_status,chospital
                where hbs_hospital_id = hoscode ORDER BY connect desc,hoscode ASC";
        $data = \Yii::$app->db->createCommand($query)->queryAll();
        $attributes = @count($data[0]) > 0 ? array_keys($data[0]) : array(); //หาชื่อ field ในตาราง
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => $attributes,
            ],
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex_user() {

        $query = "SELECT hospital_base_status.*
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_sync_start)) <= 150 AND hbs_sync_start != '0000-00-00 00:00:00',1,0) AS syncing
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,1,0) AS connect
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,1,0) AS realtime
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= 150,'ONLINE','OFFLINE') AS online
                # 24 ชั่วโมง
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= (60*60*24),1,0) AS status_online
                # 2 วัน
                ,IF((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hbs_time)) <= (60*60*24*3),1,0) AS status_sync


                ,CONCAT(hoscode,' ',hosname) as fullname

                ,CONCAT(IF(TIMESTAMPDIFF(day,hbs_sync_start,hbs_sync_finish) <> 0,CONCAT(TIMESTAMPDIFF(day,hbs_sync_start,hbs_sync_finish),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(hour,hbs_sync_start,hbs_sync_finish), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(hour,hbs_sync_start,hbs_sync_finish), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(minute,hbs_sync_start,hbs_sync_finish), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(minute,hbs_sync_start,hbs_sync_finish), 60),' นาที '),'')
                ) as usetime

                ,CONCAT(IF(TIMESTAMPDIFF(day,NOW(),hbs_sync_start) <> 0,CONCAT(TIMESTAMPDIFF(day,NOW(),hbs_sync_start),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(hour,NOW(),hbs_sync_start), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(hour,NOW(),hbs_sync_start), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(minute,NOW(),hbs_sync_start), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(minute,NOW(),hbs_sync_start), 60),' นาที '),'')
                ) as synctime

                ,CONCAT(IF(TIMESTAMPDIFF(day,NOW(),hbs_sync_finish) <> 0,CONCAT(TIMESTAMPDIFF(day,NOW(),hbs_sync_finish),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(hour,NOW(),hbs_sync_finish), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(hour,NOW(),hbs_sync_finish), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(minute,NOW(),hbs_sync_finish), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(minute,NOW(),hbs_sync_finish), 60),' นาที '),'')
                ) as lastsync

                ,CONCAT(IF(TIMESTAMPDIFF(day,NOW(),hbs_time) <> 0,CONCAT(TIMESTAMPDIFF(day,NOW(),hbs_time),' วัน '),'')
                ,IF(MOD(TIMESTAMPDIFF(hour,NOW(),hbs_time), 24) <> 0,CONCAT(MOD(TIMESTAMPDIFF(hour,NOW(),hbs_time), 24),' ชั่วโมง '),'')
                ,IF(MOD(TIMESTAMPDIFF(minute,NOW(),hbs_time), 60) <> 0,CONCAT(MOD(TIMESTAMPDIFF(minute,NOW(),hbs_time), 60),' นาที '),'')
                ) as lastonline

                FROM hospital_base_status,chospital
                where hbs_hospital_id = hoscode ORDER BY connect desc,hoscode ASC";
        $data = \Yii::$app->db->createCommand($query)->queryAll();
        $attributes = @count($data[0]) > 0 ? array_keys($data[0]) : array(); //หาชื่อ field ในตาราง
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => $attributes,
            ],
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $this->render('index_user', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HospitalBaseStatus model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HospitalBaseStatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new HospitalBaseStatus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->hbs_hospital_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HospitalBaseStatus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->hbs_hospital_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HospitalBaseStatus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HospitalBaseStatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return HospitalBaseStatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = HospitalBaseStatus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
