<?php

namespace app\modules\report\controllers;

use app\modules\report\components\Report;
use yii\data\ArrayDataProvider;

class RptController extends Report {

    public $dataProvider;
    public $beforeHeader = [];
    public $filterOption = [];

    public function init() {
        parent::init();
        //คำสั่งเรียกข้อมูลแสดงผล
        $menu = $this->getMenuDetail($_GET['items']);
        $this->sqlQuery = $menu->menu_items_sqlquery;
        @list($x, $columns, $header1, $header2, $header3, $header4, $header5) = @explode('@', $menu->menu_items_columns);
        //กำหนดค่า filter ที่ต้องการ
        $this->filterOption = [
            'showDate' => (strpos($menu->menu_items_sqlquery, '{startdate}')),
            'showAmp' => (strpos($menu->menu_items_sqlquery, '{amp}')) || strpos($menu['menu_items_sqlquery'], '{hoscode}') || (strpos($menu->menu_items_sqlquery, '{table}')),
            'showTmb' => (strpos($menu->menu_items_sqlquery, '{tmp}')),
            'showHospcode' => (strpos($menu->menu_items_sqlquery, '{hcode}') ),
            'showHospcode' => (strpos($menu['menu_items_sqlquery'], '{hoscode}') || strpos($menu['menu_items_sqlquery'], '{table}') ),
            'showFilterHostpye' => true,
        ];

        //เรียกเส้นทางในการประมวลผล
        if ($menu->menu_items_datasource !== '' && !empty($menu->menu_items_datasource)) {
            $d = trim($menu->menu_items_datasource);
            $this->dataset = \Yii::$app->$d;
        }
        if ($this->getFilter('onsubmit') == 1 || $this->getFilter('link')) {
            if ($menu->menu_items_typeprocess === 'oneprocess') {
                $this->dataProvider = $this->process();
            } else {
                $this->dataProvider = $this->processByManyDb();
            }
        } else {
            //กรณียังไม่กดประมวลผล
            $this->dataProvider = new ArrayDataProvider([]);
            if (!$this->columns)
                $this->columns = [];
        }


        $summary = [];
        $data = [];
        if (isset($this->dataProvider)) {
            $dataprovider = $this->dataProvider->allModels;
            foreach ((array) $dataprovider as $data) {
                foreach ((array) $dataprovider[0] as $key => $h) {
                    @$summary[$key] += @(double) $data[$key];
                }
            }
        }

        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header1 . "]];"));
        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header2 . "]];"));
        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header3 . "]];"));
        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header4 . "]];"));
        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header5 . "]];"));

        $this->columns = eval('return [' . $columns . '];');
    }

    public function actionIndex() {
        //แสดง view รายงาน
        return $this->render('@app/modules/report/views/v/index', [
                    'dataProvider' => $this->dataProvider,
                    'columns' => $this->columns,
                    'beforeHeader' => $this->beforeHeader,
                    'filterOption' => $this->filterOption,
        ]);
    }

}
