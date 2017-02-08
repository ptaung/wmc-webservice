<?php

namespace app\modules\webclient\controllers;

use Yii;
use yii\web\Controller;
use app\modules\webclient\components\Cdata;
use yii\data\ArrayDataProvider;

class PaController extends Controller {

    public function actionIndex() {
        $sql = "SELECT hospcode FROM pcu_hos_allow #WHERE hospcode in (" . Cdata::levelLookup() . ")";
        $hosArray = yii::$app->db_datacenter->createCommand($sql)->queryAll();
        $sqlString = '';

        $preVar = 'p';

        $hColumns2 = "[
                    'label' => 'ภาพรวม',
                    'attribute' => '{$preVar}',
                    'format' => 'raw',
                    'hAlign' => 'right',
                    'width' => '50px;',
                    'value' => function(\$data) {
                        if(\$data['{$preVar}'] >= \$data['{$preVar}_hdc']){
                            \$wmc = '<span class=\"text-success\" style=\"font-size:18px;\">'.(\$data['{$preVar}'] <> ''?\$data['{$preVar}']:0).'</span>';
                            \$hdc = '<span class=\"text-warning\">'.(\$data['{$preVar}_hdc'] <> ''?\$data['{$preVar}_hdc']:0).'</span>';
                        }else{
                            \$wmc = '<span class=\"text-warning\">'.(\$data['{$preVar}'] <> ''?\$data['{$preVar}']:'0').'</span>';
                            \$hdc = '<span class=\"text-success\">'.(\$data['{$preVar}_hdc'] <> ''?\$data['{$preVar}_hdc']:0).'</span>';
                        }

                        return '<b>'.\$wmc.'</b><br>'.\$hdc;
                    }
                ],[
                    'label' => '',
                    'format' => 'raw',
                    'width' => '50px;',
                ],";


        foreach ($hosArray as $key => $value) {
            $sqlString .= ",SUM(IF(s='WMC' && ws.hospcode = '{$value['hospcode']}',ws.ss_target,null)) AS t{$value['hospcode']}
                    ,SUM(IF(s='WMC' && ws.hospcode = '{$value['hospcode']}',ws.ss_result,NULL)) AS r{$value['hospcode']}
                    ,ROUND((SUM(IF(s='WMC' && ws.hospcode = '{$value['hospcode']}',ss_result,0))/SUM(IF(s='WMC' && ws.hospcode = '{$value['hospcode']}',ss_target,0)))*100,2) AS p{$value['hospcode']}


                    ,SUM(IF(s='HDC' && ws.hospcode = '{$value['hospcode']}',ws.ss_target,null)) AS t{$value['hospcode']}_hdc
                    ,SUM(IF(s='HDC' && ws.hospcode = '{$value['hospcode']}',ws.ss_result,NULL)) AS r{$value['hospcode']}_hdc
                    ,ROUND((SUM(IF(s='HDC' && ws.hospcode = '{$value['hospcode']}',ss_result,0))/SUM(IF(s='HDC' && ws.hospcode = '{$value['hospcode']}',ss_target,0)))*100,2) AS p{$value['hospcode']}_hdc
                    ";

            $var = $preVar . $value['hospcode'];

            $hColumns2 .= "[
              'label' => '{$value['hospcode']}',
              'attribute' => 'p{$value['hospcode']}',
              'format' => 'raw',
              'hAlign' => 'right',
              'width' => '30px;',
              'value' => function(\$data) {
                    if(\$data['{$var}'] >= \$data['{$var}_hdc']){
                    \$wmc = '<span class=\"text-success\"  style=\"font-size:18px;\">'.(\$data['{$var}'] <> ''?\$data['{$var}']:'0').'</span>';
                    \$hdc = '<span class=\"text-warning\">'.(\$data['{$var}_hdc'] <> ''?\$data['{$var}_hdc']:'0').'</span>';
                    }else{
                    \$wmc = '<span class=\"text-warning\">'.(\$data['{$var}'] <> ''?\$data['{$var}']:'0').'</span>';
                    \$hdc = '<span class=\"text-success\">'.(\$data['{$var}_hdc'] <> ''?\$data['{$var}_hdc']:'0').'</span>';
              }

              return '<b>'.\$wmc.'</b><br>'.\$hdc;
              }
              ],";
        }


        $query = "SELECT
                    p.wmc_procedure_comment
                    {$sqlString}
                    ,SUM(IF(s='WMC',ss_target,0)) AS t
                    ,SUM(IF(s='WMC',ss_result,0)) AS r
                    ,ROUND((SUM(IF(s='WMC',ss_result,0))/SUM(IF(s='WMC',ss_target,0)))*100,2) AS p

                    ,SUM(IF(s='HDC',ss_target,0)) AS t_hdc
                    ,SUM(IF(s='HDC',ss_result,0)) AS r_hdc
                    ,ROUND((SUM(IF(s='HDC',ss_result,0))/SUM(IF(s='HDC',ss_target,0)))*100,2) AS p_hdc
                    FROM wmc_procedure p
                    LEFT JOIN (
                    SELECT *,'WMC' AS s FROM xws_summary WHERE b_year = (SELECT yearprocess+543 FROM wmc_config LIMIT 1)
                    UNION ALL
                    SELECT *,'HDC' AS s FROM xws_summary_hdc WHERE b_year = (SELECT yearprocess+543 FROM wmc_config LIMIT 1)
                    ) ws ON ws.ws_md5 = MD5(wmc_procedure_name)
                    LEFT JOIN pcu_hos_allow h ON ws.hospcode = h.hospcode
                    WHERE wmc_procedure_name
                    IN ('ws_childdev_specialpp','ws_postnatal','ws_dm_control','ws_ht_control','ws_kpi_ckd_screen','ws_anc5','ws_kpi_anc12','ws_dm_screen_pop_age','ws_ht_screen_pop_age')
                    AND ws.b_year = (SELECT yearprocess+543 FROM wmc_config LIMIT 1)
                    GROUP BY wmc_procedure_name

            ";

        try {
            $result = yii::$app->db_datacenter->createCommand($query)->queryAll();
            $attributes = @count($result[0]) > 0 ? array_keys($result[0]) : array(); //หาชื่อ field ในตาราง
            $dataProvider = new ArrayDataProvider([
                'allModels' => $result,
                'sort' => [
                    'attributes' => $attributes,
                #'defaultOrder' => ['village_name' => SORT_DESC, 'screen_date' => SORT_DESC]
                ],
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \yii\web\HttpException(405, 'Error MySQL Query' . $e->getMessage());
            $dataProvider = new ArrayDataProvider();
        }

        $hColumns = "return [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ตัวชี้วัด',
                'attribute' => 'wmc_procedure_comment',
            ],
            [
                'label' => 'แหล่งข้อมูล',
                'hAlign' => 'right',
                'width' => '50px;',
                'format' => 'raw',
                'value' => function(\$data) {
                    return '<b>WMC</b><br>HDC';
                }
            ],";

        $hColumns .= $hColumns2 . '];';
        $columns = eval($hColumns);



        return $this->render('index', [ 'dataProvider' => $dataProvider, 'columns' => $columns]);
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
