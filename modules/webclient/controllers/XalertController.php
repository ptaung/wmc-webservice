<?php

namespace app\modules\webclient\controllers;

use Yii;
use yii\web\Controller;
use app\modules\webclient\components\Cdata;
use yii\data\ArrayDataProvider;

class XalertController extends Controller {

    public function actionIndex() {
        $sql = "SELECT
                    eid,wmc_xalert_title
                    ,SUM(cc) AS error
                    FROM xalertsummary a1,wmc_xalert a2
                    WHERE 1
                    AND a1.eid = a2.wmc_xalert_id
                    AND hospcode in (" . Cdata::levelLookup() . ")
                    GROUP BY eid  ORDER BY error DESC";
        try {
            $data = Yii::$app->db_datacenter->createCommand($sql)->cache(3600)->queryAll();
        } catch (\Exception $exc) {
            $data = [];
        }
        echo json_encode($data);
    }

    public function actionReport() {
        $query = "SELECT
                    eid,wmc_xalert_title
                    ,SUM(cc) AS error
                    FROM xalertsummary a1,wmc_xalert a2
                    WHERE 1
                    AND a1.eid = a2.wmc_xalert_id
                    AND hospcode in (" . Cdata::levelLookup() . ")
                    GROUP BY eid  ORDER BY error DESC";

        try {
            $result = Yii::$app->db_datacenter->createCommand($query)->cache(3600)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 1000,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('report', ['dataProvider' => $dataProvider, 'point' => $dataProvider->allModels]);
    }

    public function actionReportdetail($id) {
        $query = "SELECT wmc_xalert_title,a1.*
                    FROM {$id} a1,wmc_xalert a2
                    WHERE a1.eid = a2.wmc_xalert_id
                    AND hospcode in (" . Cdata::levelLookup() . ")";

        try {
            $result = Yii::$app->db_datacenter->createCommand($query)->cache(3600)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 1000,
                ],
            ]);
        } catch (\Exception $e) {
            #throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        return $this->render('reportdetail', ['dataProvider' => $dataProvider, 'point' => $dataProvider->allModels]);
    }

}
