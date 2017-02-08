<?php

namespace app\modules\webclient\controllers;

use app\modules\webclient\components\Report;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;

class RptController extends Report {

    public $dataProvider;
    public $beforeHeader = [];
    public $filterOption = [];
    public $rptDetail = [];
    public $individual = true;
    public $summary = [];
    public $chart = [];

    public function init() {
        parent::init();
//คำสั่งเรียกข้อมูลแสดงผล
        $menu = $this->getMenuDetail(\Yii::$app->request->get('items'));
        $item = \Yii::$app->request->get('items');
        if (empty($item) || count($menu) == 0) {
            throw new \yii\web\HttpException(403, 'ไม่พบรายงาน กรุณาลองเลือกใหม่ค่ะ');
        }


//ตรวจสอบสิทธิการเข้าถึงข้อมูลแบบรายบุคคล
        if ($menu['individual'] == 1) {
            if (\Yii::$app->user->can('individual')) {
                $this->individual = true;
            } else {
                $this->individual = false;
                throw new \yii\web\HttpException(403, 'คุณไม่ได้รับอนุญาต รายงานนี้เป็นข้อมูลรายบุคคล');
            }
        }

        $menu['menu_items_sqlquery'] = base64_decode($menu['menu_items_sqlquery']);
        $menu['menu_items_columns'] = base64_decode($menu['menu_items_columns']);
        $menu['menu_items_param'] = base64_decode($menu['menu_items_param']);
        $this->sqlQuery = $menu['menu_items_sqlquery'];
        $this->rptDetail['menu_items_name'] = $menu['menu_items_name'];
        $this->rptDetail['menu_items_comment'] = $menu['menu_items_comment'];

        @list($x, $columns, $header1, $header2, $header3, $header4, $header5) = @explode('@', $menu['menu_items_columns']);

        //กำหนดค่า filter ที่ต้องการ
        $this->filterOption = [
            'showDate' => (strpos($menu['menu_items_sqlquery'], '{startdate}')),
            'showAmp' => (strpos($menu['menu_items_sqlquery'], '{amp}')) || (strpos($menu['menu_items_sqlquery'], '{table}')),
            'showTmb' => (strpos($menu['menu_items_sqlquery'], '{tmp}')),
            'showHospcode' => true,
            'showFilterHostpye' => true,
        ];

//เรียกเส้นทางในการประมวลผล
        if ($menu['menu_items_datasource'] !== '' && !empty($menu['menu_items_datasource'])) {
            $d = trim($menu['menu_items_datasource']);
            $this->dataset = \Yii::$app->$d;
        }
        if ($this->getFilter('onsubmit') == 1 || $this->getFilter('link')) {
            if ($menu['menu_items_typeprocess'] === 'oneprocess') {
                $this->dataProvider = $this->process();
            } else {
                $this->dataProvider = $this->processByManyDb();
            }
        } else {
//กรณียังไม่กดประมวลผล
            $this->dataProvider = new ArrayDataProvider([]);
            if (!$this->columns) {
                $this->columns = [];
            }
        }


        $summary = [];
        $data = [];
        if (isset($this->dataProvider->allModels)) {
            $dataprovider = $this->dataProvider->allModels;
            foreach ((array) $dataprovider as $data) {
                foreach ((array) $dataprovider[0] as $key => $h) {
                    @$summary[$key] += @(double) $data[$key];
                    //ส่งค่าไปทำ chart
                    #$this->summary[$key] += (double) $data[$key];
                }
            }
        }


        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header1 . "]];"));
        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header2 . "]];"));
        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header3 . "]];"));
        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header4 . "]];"));
        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header5 . "]];"));
        $this->columns = eval('return [' . $columns . '];');


        if (isset($this->dataProvider->allModels) && !empty($menu['menu_items_param'])) {
            //--------------------------------------------
            $chart = eval("return {$menu['menu_items_param']};");
            /*
              [
              'type' => 'spline',
              'cat' => 'hosname',
              'series' => [
              ['name' => 'จำนวน Refer ผู้ป่วยใน', 'data' => ['name' => 'hosname', 'value' => 'cases_ipd']],
              ['name' => 'จำนวน Refer ผู้ป่วยนอก', 'data' => ['name' => 'hosname', 'value' => 'cases_opd']]
              ]
              ];
             *
             */


            $series = [];
            foreach ($this->dataProvider->allModels as $key => $rows) {
                foreach ($chart['series'] as $key => $sdata) {
                    $c = $sdata['data']['name'];
                    $data[$key][] = [
                        $rows[$c],
                        (float) $rows[$sdata['data']['value']]
                    ];
                }
            }

            $cat[] = $rows[$chart['cat']]; //categories
            foreach ($chart['series'] as $key => $sdata) {
                $series[] = ['name' => $sdata['name'], 'data' => $data[$key]];
            }
            $chart['series'] = $series;
            $this->chart = $chart;
            //--------------------------------------------
        }
    }

//ตรวจสอบสิทธิการเข้าถึงข้อมูลแบบรายบุคคล

    public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => $this->individual,
                        'actions' => ['index'],
                    //'roles' => ['individual'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
//แสดง view รายงาน
        return $this->render('@app/modules/webclient/views/v/index', ['dataProvider' => $this->dataProvider,
                    'columns' => $this->columns,
                    'beforeHeader' => $this->beforeHeader,
                    'filterOption' => $this->filterOption,
                    'rptDetail' => $this->rptDetail,
                    'summary' => $this->summary,
                    'chart' => $this->chart,
        ]);
    }

}
