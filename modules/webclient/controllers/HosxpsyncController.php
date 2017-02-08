<?php

namespace app\modules\webclient\controllers;

use yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;

class HosxpsyncController extends Controller {

    public function actionIndex() {

        $query = "SELECT
	d.hospcode
	,hosxp_version
        ,last_update
	,send_status
        ,complete_percent
        ,IF(TIMEDIFF(etl_end_time, etl_begin_time) > '00:00:00',
        TIMEDIFF(etl_end_time, etl_begin_time),
        '-') AS usetime,

    case
    when (TO_DAYS(CURDATE()) - TO_DAYS(e.last_full_sync_date)) = 0 then 'วันนี้'
    when (TO_DAYS(CURDATE()) - TO_DAYS(e.last_full_sync_date)) > 0 then concat((TO_DAYS(CURDATE()) - TO_DAYS(e.last_full_sync_date)),' วันที่แล้ว')
    end
AS p

,
    CONCAT(h.hosptype, ' ', h.name) AS hname
FROM
    datacenter.dw_hospcode_allow d
        LEFT OUTER JOIN
    hospcode h ON h.hospcode = d.hospcode
        INNER JOIN
    pcu_hos_allow pha ON pha.hospcode = d.hospcode
        LEFT OUTER JOIN
    datacenter.online_etl e ON e.hospcode = d.hospcode

    WHERE pha.hospcode <> pha.hospcode_cup
";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider_pcu = new ArrayDataProvider([
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
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider_pcu = new ArrayDataProvider();
        }




        $query = "SELECT
	d.hospcode
	,hosxp_version
        ,last_update
	,send_status
        ,complete_percent
        ,IF(TIMEDIFF(etl_end_time, etl_begin_time) > '00:00:00',
        TIMEDIFF(etl_end_time, etl_begin_time),
        '-') AS usetime,

    case
    when (TO_DAYS(CURDATE()) - TO_DAYS(e.last_full_sync_date)) = 0 then 'วันนี้'
    when (TO_DAYS(CURDATE()) - TO_DAYS(e.last_full_sync_date)) > 0 then concat((TO_DAYS(CURDATE()) - TO_DAYS(e.last_full_sync_date)),' วันที่แล้ว')
    end
AS p


,
    CONCAT(h.hosptype, ' ', h.name) AS hname

FROM
    datacenter.dw_hospcode_allow d
        LEFT OUTER JOIN
    hospcode h ON h.hospcode = d.hospcode
        INNER JOIN
    pcu_hos_allow pha ON pha.hospcode = d.hospcode
        LEFT OUTER JOIN
    datacenter.online_etl e ON e.hospcode = d.hospcode WHERE pha.hospcode = pha.hospcode_cup";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider_hos = new ArrayDataProvider([
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
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider_hos = new ArrayDataProvider();
        }

        return $this->render('index', array(
                    'dataProvider_pcu' => $dataProvider_pcu,
                    'dataProvider_hos' => $dataProvider_hos,
        ));
    }

}
