<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\webclient\models\VaccineType;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ทะเบียนข้อมูลหญิงตั้งครรภ์ ' . (isset($_GET['q_byear']) ? 'ช่วงแสดงผลข้อมูลการฝากครรภ์หรือคลอดแล้ว ระหว่างวันที่ ' . Cwebclient::getThaiDate(($_GET['q_byear'] - 1 ) . '-10-01') . " ถึง " . Cwebclient::getThaiDate(($_GET['q_byear'] ) . '-09-30') : '');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-group-index">
    <?php
    //คำนวณตัวเลือกรายงาน
    $y = date('Y') - 2;
    $s = date('Y') + 2;
    for ($y; $y < $s; $y++) {
        $byear[$y] = $y + 543;
    }

    if (strlen(\Yii::$app->params['ampcode']) == 4) {
        $ampcode = " and concat(provcode,distcode) = '" . \Yii::$app->params['ampcode'] . "' ";
    } else {
        $ampcode = '';
    }
    $dataselect = (isset($_GET['q_hospcode']) ? $_GET['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);

    if (!\Yii::$app->user->can('super_admin')) {
        $sqlStringAdd = " and hoscode='{$dataselect}' ";
    }

    $provcode = \Yii::$app->params['provcode'];
    $data = Chospital::find()->where("hostype in ('03','05','06','07','18' ) $ampcode and provcode = '{$provcode}' {$sqlStringAdd}")->orderBy('hoscode ASC')->all();
    ?>
    <div class="well small" role="alert">
        <p>
            ข้อมูลการให้บริการฝากครรภ์กับหญิงตั้งครรภ์ที่มารับบริการ และประวัติการฝากครรภ์ของหญิงตั้งครรภ์ในเขตรับผิดชอบ
        </p>
        <p>
            <span class="btn btn-success btn-xs">ให้บริการ</span> หมายถึง หน่วยบริการทำการบันทึกบริการหรือเก็บความครอบคลุมบริการเรียบร้อยแล้ว
        </p>
        <p>
            <span class="btn btn-info btn-xs">ให้บริการที่อื่น</span> หมายถึง มีการบันทึกการให้บริการจากหน่วยบริการอื่น
        </p>
        <p>
            <span class="btn btn-warning btn-xs">บริการ/ที่อื่น</span> หมายถึง มีการบันทึกการให้บริการจากหน่วยบริการอื่นและ<b>สถานบริการที่รับผิดชอบยังไม่ได้บันทึกการให้บริการหรือความครอบคลุม</b>
        </p>
        <p>
            <span class="btn btn-default btn-xs">ยังไม่ได้รับ</span> หมายถึง หญิงตั้งครรภ์ยังไม่เคยได้รับการบันทึกการให้บริการหรือความครอบคลุมบริการเลย
        </p>



    </div>

    <?php
    if (isset($_GET['q_hospcode']))
        echo app\modules\webclient\components\Cmapclient::widget(['point' => $point, 'zoom' => 12, 'height' => 300]);
    ?>
    <div class="">
        <?=
        GridView::widget([
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> ' . $this->title . '</h3>',
                'type' => 'default',
                'before' => '<div class="btn-group" role="group" aria-label="">'
                . '<form class="navbar-form navbar-left" method="GET" role="search" data-pjax="true">
  <div class="form-group">
    ' . Html::textInput('q_search', $_GET['q_search'], ['class' => 'form-control input-sm', 'placeholder' => 'ค้นหารายชื่อ-เลข 13 หลัก']) . '
    ' . Html::dropDownList('q_byear', (isset($_GET['q_byear']) ? $_GET['q_byear'] : date('Y')), $byear, ['class' => 'form-control input-sm', 'prompt' => ' ++ปีงบประมาณ++']) . '
    ' . Html::dropDownList('q_hospcode', $dataselect, \yii\helpers\ArrayHelper::map($data, 'hoscode', 'fullname'), ['class' => 'form-control input-sm', 'prompt' => ' ++เลือกสถานบริการ++']) . '
  </div>
  <button type="submit" class="btn btn-success btn-sm">แสดงข้อมูล</button>
</form>'
            ],
            'beforeHeader' => [
                [
                    'columns' => [
                        ['content' => 'ข้อมูลหญิงตั้งครรภ์', 'options' => ['colspan' => 7, 'class' => 'text-center warning']],
                        ['content' => 'บริการก่อนคลอด', 'options' => ['colspan' => 5, 'class' => 'text-center info']],
                        ['content' => '', 'options' => ['colspan' => 1, 'class' => '']],
                        ['content' => 'บริการหลังคลอด', 'options' => ['colspan' => 4, 'class' => 'text-center info']],
                    ],
                #'options' => ['class' => 'skip-export'] // remove this row from export
                ]
            ],
            'export' => [
                'label' => 'ส่งออกรายงาน',
            ],
            'exportConfig' => [
                GridView::EXCEL => ['label' => 'บันทึกเป็น EXCEL'],
            #GridView::PDF => ['label' => 'บันทึกเป็น PDF'],
            ],
            #'pjax' => true,
            'responsiveWrap' => true,
            'responsive' => true,
            #'floatHeader' => true,
            #'export' => false,
            'dataProvider' => $dataProvider,
            'showPageSummary' => false,
            'rowOptions' => function ($model, $index, $widget, $grid) {
        if ($model['inputdata'] == 0) {
            return ['class' => 'default'];
        } else {
            return [];
        }
    },
            'columns' => [

                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'label' => 'ชื่อ-สกุล',
                    'attribute' => 'person_name',
                    'format' => 'raw',
                    'value' => function($data) {
                        return '<b>' . $data['cid'] . '</b><br>' . $data['person_name'];
                    }
                ],
                [
                    'label' => 'ที่อยู่',
                    'attribute' => 'address_name',
                    'format' => 'raw',
                    'value' => function($data) {
                        return '<small>' . $data['address_name'] . '</small>';
                    },
                ],
                [
                    'label' => 'วันเกิด',
                    'attribute' => 'birthdate',
                    'visible' => 0,
                    'format' => 'text',
                    'value' => function($data) {
                        return Cwebclient::getThaiDate($data['birthdate']);
                    }
                ],
                [
                    'label' => 'อายุ',
                    'attribute' => 'age',
                    'visible' => 0,
                ],
                [
                    'label' => 'Typearea',
                    'attribute' => 'house_regist_type_id',
                    'visible' => 1,
                ],
                [
                    'label' => 'LMP',
                    'attribute' => 'lmp',
                    'visible' => 1,
                ],
                [
                    'label' => 'รายการติดตาม',
                    'attribute' => 'inputdata',
                    'visible' => 1,
                    'format' => 'raw',
                    #'group' => true,
                    #'groupedRow' => true,
                    'value' => function($data) {
                        if ($data['inputdata'] == 1) {
                            $ref = '<small>ต้องนำเข้าทะเบียนหญิงตั้งครรภ์</small>';
                        } else {
                            $ref = '';
                        }
                        return $ref;
                    },
                ],
                [
                    'label' => 'ครรภ์ที่',
                    'attribute' => 'preg_no',
                    'format' => 'raw',
                    'value' => function($data) {
                        return "<b>{$data['preg_no']}</b>";
                    }
                ],
                [
                    'label' => 'ขึ้นทะเบียนฝากครรภ์',
                    'attribute' => 'pregnancy',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayAncPlaceFormat($data['pregnancy']);
                    }
                ],
                [
                    'label' => 'สถานะการคลอด',
                    'attribute' => 'labour_place',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayAncLaborPlaceFormat($data['labour_place']);
                    }
                ],
                [
                    'label' => 'แท้ง',
                    'attribute' => 'labour_place',
                    'visible' => 0,
                    'format' => 'raw',
                #'value' => function($data) {
                #return Cwebclient::displayAncLaborPlaceFormat($data['labour_place']);
                #}
                ],
                [
                    'label' => 'ครั้งที่ 1',
                    'attribute' => 'precare1',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayAnc($data, 'precare1');
                    },
                ],
                [
                    'label' => 'ครั้งที่ 2',
                    'attribute' => 'precare2',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayAnc($data, 'precare2');
                    },
                ],
                [
                    'label' => 'ครั้งที่ 3',
                    'attribute' => 'precare3',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayAnc($data, 'precare3');
                    },
                ],
                [
                    'label' => 'ครั้งที่ 4',
                    'attribute' => 'precare4',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayAnc($data, 'precare4');
                    },
                ],
                [
                    'label' => 'ครั้งที่ 5',
                    'attribute' => 'precare5',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayAnc($data, 'precare5');
                    },
                ],
                [
                    'label' => '',
                    'format' => 'raw',
                    'value' => function($data) {
                        return '';
                    },
                ],
                [
                    'label' => 'ครั้งที่ 1',
                    'attribute' => 'care1',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayAnc($data, 'care1');
                    },
                ],
                [
                    'label' => 'ครั้งที่ 2',
                    'attribute' => 'care2',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayAnc($data, 'care2');
                    },
                ],
                [
                    'label' => 'ครั้งที่ 3',
                    'attribute' => 'care3',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayAnc($data, 'care3');
                    },
                ],
                [
                    'label' => 'บันทึกนอกเกณฑ์',
                    'attribute' => 'care_error',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayAnc($data, 'care_error', 'error');
                        #return $data['care_error'];
                    },
                ],
            ],
        ]);
        ?>
        <?php #yii\widgets\Pjax::end()       ?>
    </div>
</div>
