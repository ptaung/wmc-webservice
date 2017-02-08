<?php

namespace app\modules\hdcservice\controllers;

use app\modules\hdcservice\components\Report;
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
        $this->tableFilter = $menu->sysreport->source_table;

        @list($x, $columns, $header1, $header2, $header3, $header4, $header5) = @explode('@@', $menu->menu_items_columns);
        #show summary gridvice
        #$total_value = [100];
        //เรียกเส้นทางในการประมวลผล
        if ($this->getFilter('onsubmit') == 1 || $this->getFilter('link')) {
            $this->dataProvider = $this->process();
        } else {
            //กรณียังไม่กดประมวลผล
            $this->dataProvider = new ArrayDataProvider([]);
            if (!$this->columns)
                $this->columns = [];
        }

        $summary = [];
        $data = [];
        $dataprovider = $this->dataProvider->allModels;
        foreach ((array) $dataprovider as $data) {
            foreach ((array) $dataprovider[0] as $key => $h) {
                $summary[$key] += (double) $data[$key];
            }
        }
        $clabel = $this->clabel;
        #echo '<br><br><br><pre>';
        //print_r($this->dataProvider->allModels);
        #print_r($summary);
        #echo '</pre>';


        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header1 . "]];"));
        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header2 . "]];"));
        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header3 . "]];"));
        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header4 . "]];"));
        array_push($this->beforeHeader, eval("return ['columns'=>[" . $header5 . "]];"));
        $this->columns = eval('return [' . $columns . '];');

        //กำหนดค่า filter ที่ต้องการ
        $this->filterOption = [
            'clabel' => $this->clabel
        ];
    }

    public function actionIndex() {

        //แสดง view รายงาน
        return $this->render('@app/modules/' . $this->module->id . '/views/v/index', [
                    'dataProvider' => $this->dataProvider,
                    'columns' => $this->columns,
                    'beforeHeader' => $this->beforeHeader,
                    'filterOption' => $this->filterOption,
        ]);
    }

}
