<?php

namespace app\modules\wmcsync\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;

class DlcController extends Controller {

    public function actionIndex() {
        $hospcode = \Yii::$app->user->identity->profile->hospcode;
        $query = "SELECT if(operation='INSERT','ลงทะเบียนหญิงตั้งครรภ์','เพิ่มข้อมูลฝากครรภ์ที่อื่น') as operation,COUNT(*) AS cc FROM wmc_tranfer_command WHERE hospcode = '{$hospcode}' AND wtc_active = 1 AND command_status <> 'success' GROUP BY operation ";
        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $result = [];
        }

        echo json_encode($result);
    }

    public function actionAnc() {
        $hospcode = \Yii::$app->user->identity->profile->hospcode;
        $query = "SELECT * FROM wmc_tranfer_command WHERE hospcode = '{$hospcode}' AND wtc_active = 1 ORDER BY command_status DESC,confirmtime ASC";
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
        } return $this->render('anc', ['dataProvider' => $dataProvider]);
    }

    public function actionDlc() {
        $post = yii::$app->request->post();
        $id = $post['id'];
        $dlc = $post['dlc'];

        yii::$app->db_datacenter->createCommand()->update('wmc_tranfer_command', ['confirmtime' => ($dlc == 0 ? '' : new \yii\db\Expression('NOW()'))], ['wtc_id' => $id])->execute();
        echo 'SUCCESS COMMAND';
    }

}
