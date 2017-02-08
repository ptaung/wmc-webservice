<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\webclient\models\VaccineType;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลการได้รับวัคซีนเด็กของอายุ 0-5 ปี ' . (isset($_GET['q_byear']) ? 'คำนวณอายุ ณ วันที่ ' . Cwebclient::getThaiDate(($_GET['q_byear'] - (($_GET['q_age'] <> '' ? $_GET['q_age'] : 5) + 1)) . '-10-01') . " ถึง " . Cwebclient::getThaiDate(($_GET['q_byear'] - ($_GET['q_age'] <> '' ? $_GET['q_age'] : 0)) . '-09-30') : '');
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
            <span class="btn btn-success btn-xs">รับแล้ว</span> หมายถึง หน่วยบริการทำการบันทึกบริการหรือเก็บความครอบคลุมวัคซีนเรียบร้อยแล้ว
        </p>
        <p>
            <span class="btn btn-info btn-xs">รับที่อื่น</span> หมายถึง มีการบันทึกการให้บริการวัคซีนจากหน่วยบริการอื่น
        </p>
        <p>
            <span class="btn btn-warning btn-xs">บริการ/รับที่อื่น</span> หมายถึง มีการบันทึกการให้บริการวัคซีนจากหน่วยบริการอื่นและ<b>สถานบริการที่รับผิดชอบเด็กยังไม่ได้บันทึกการให้บริการหรือความครอบคลุมวัคซีน</b>
        </p>
        <p>
            <span class="btn btn-default btn-xs">ยังไม่ได้รับ</span> หมายถึง เด็กยังไม่เคยได้รับการบันทึกการให้บริการหรือความครอบคลุมวัคซีนเลย
        </p>
        <p>
            อ้างอิงการให้รหัสมาตรฐานจาก HDC
        </p>
    </div>
    <?php
    if (isset($_GET['q_hospcode']))
        echo app\modules\webclient\components\Cmapclient::widget(['point' => $point, 'zoom' => 12, 'height' => 300]);
    ?>
    <div class="small">
        <?=
        GridView::widget([

            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> ' . $this->title . '</h3>',
                'type' => 'default',
                'before' => '<div class="btn-group" role="group" aria-label="">'
                . '<form class="navbar-form navbar-left" method="GET" role="search" data-pjax="true">
  <div class="form-group">
    ' . Html::textInput('q_search', $_GET['q_search'], ['class' => 'form-control input-sm', 'placeholder' => 'ค้นหารายชื่อ-เลข 13 หลัก']) . '
    ' . Html::dropDownList('q_age', (isset($_GET['q_age']) ? $_GET['q_age'] : ''), [0 => '0 ปี', 1 => '1 ปี', 2 => '2 ปี', 3 => '3 ปี', 4 => '4 ปี', 5 => '5 ปี'], ['class' => 'form-control input-sm', 'prompt' => ' ++อายุเด็ก 0-5 ปี++']) . '
    ' . /* Html::dropDownList('q_vaccine', $_GET['q_vaccine'], \yii\helpers\ArrayHelper::map(VaccineType::find()->where("export_code in ('010','041','093','083','061')")->all(), 'export_code', 'fullname'), ['class' => 'form-control input-sm', 'prompt' => '++ประเภท Vaccine++']) */ '' . '
    ' . Html::dropDownList('q_byear', (isset($_GET['q_byear']) ? $_GET['q_byear'] : date('Y')), $byear, ['class' => 'form-control input-sm', 'prompt' => ' ++ปีงบประมาณ++']) . '
    ' . Html::dropDownList('q_hospcode', $dataselect, \yii\helpers\ArrayHelper::map($data, 'hoscode', 'fullname'), ['class' => 'form-control input-sm', 'prompt' => ' ++เลือกสถานบริการ++']) . '
  </div>
  <button type="submit" class="btn btn-success btn-sm">แสดงข้อมูล</button>
</form>'
            ],
            'beforeHeader' => [
                [
                    'columns' => [
                    #['content' => 'ข้อมูลเด็ก', 'options' => ['colspan' => 5, 'class' => 'text-center warning']],
                    #['content' => 'วัคซีนเด็กอายุ 1 ปี', 'options' => ['colspan' => 5, 'class' => 'text-center info']],
                    #['content' => 'วัคซีนเด็กอายุ 2 ปี', 'options' => ['colspan' => 3, 'class' => 'text-center info']],
                    #['content' => 'วัคซีนเด็กอายุ 3 ปี', 'options' => ['colspan' => 2, 'class' => 'text-center info']],
                    #['content' => 'วัคซีนเด็กอายุ 5 ปี', 'options' => ['colspan' => 2, 'class' => 'text-center info']],
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
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
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
                ],
                [
                    'label' => 'วันเกิด',
                    'attribute' => 'birthdate',
                    'format' => 'text',
                    'value' => function($data) {
                        return Cwebclient::getThaiDate($data['birthdate']);
                    }
                ],
                [
                    'label' => 'อายุ',
                    'attribute' => 'age',
                ],
                [
                    'label' => 'สถานะการอยู่อาศัย',
                    'attribute' => 'house_regist_type_id',
                    'visible' => 0,
                ],
                [
                    'label' => 'หมู่บ้าน',
                    'attribute' => 'village_name',
                    'visible' => 1,
                    'group' => true,
                    'groupedRow' => true,
                ],
                [
                    'label' => 'BCG(010)',
                    'attribute' => 'bcg',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'bcg');
                    },
                ],
                [
                    'label' => 'HBV1(041)',
                    'attribute' => 'hbv1',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'hbv1');
                    },
                ],
                [
                    'label' => 'OPV1(081)',
                    'attribute' => 'opv1',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'opv1');
                    },
                ],
                [
                    'label' => 'OPV2(082)',
                    'attribute' => 'opv2',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'opv2');
                    },
                ],
                [
                    'label' => 'OPV3(083)',
                    'attribute' => 'opv3',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'opv3');
                    },
                ],
                [
                    'label' => 'DTP-HBV1(091)',
                    'attribute' => 'dtp_hbv1',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'dtp_hbv1');
                    },
                ],
                [
                    'label' => 'DTP-HBV2(092)',
                    'attribute' => 'dtp_hbv2',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'dtp_hbv2');
                    },
                ],
                [
                    'label' => 'DTP-HBV3(093)',
                    'attribute' => 'dtp_hbv3',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'dtp_hbv3');
                    },
                ],
                [
                    'label' => 'MMR(061)',
                    'attribute' => 'mmr',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'mmr');
                    },
                ],
                [
                    'label' => 'DTP4',
                    'attribute' => 'dtp4',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'dtp4');
                    },
                ],
                [
                    'label' => 'OPV4',
                    'attribute' => 'opv4',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'opv4');
                    },
                ],
                [
                    'label' => 'JE1(051)',
                    'attribute' => 'je1',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'je1');
                    },
                ],
                [
                    'label' => 'JE2(052)',
                    'attribute' => 'je2',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'je2');
                    },
                ],
                [
                    'label' => 'JE3(053)',
                    'attribute' => 'je3',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'je3');
                    },
                ],
                [
                    'label' => 'J11',
                    'attribute' => 'j11',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'j11');
                    },
                ],
                [
                    'label' => 'J12',
                    'attribute' => 'j12',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'j12');
                    },
                ],
                [
                    'label' => 'MMR2(073)',
                    'attribute' => 'mmr2',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'mmr2');
                    },
                ],
                [
                    'label' => 'HBV2(042)',
                    'attribute' => 'hbv2',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'hbv2');
                    },
                ],
                [
                    'label' => 'HBV3(043)',
                    'attribute' => 'hbv3',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'hbv3');
                    },
                ],
                [
                    'label' => 'DTP1(031)',
                    'attribute' => 'dtp1',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'dtp1');
                    },
                ],
                [
                    'label' => 'DTP2(032)',
                    'attribute' => 'dtp2',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'dtp2');
                    },
                ],
                [
                    'label' => 'DTP3(033)',
                    'attribute' => 'dtp3',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'dtp3');
                    },
                ],
                [
                    'label' => 'DTP5(035)',
                    'attribute' => 'dtp5',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'dtp5');
                    },
                ],
                [
                    'label' => 'OPV5(085)',
                    'attribute' => 'opv5',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'opv5');
                    },
                ],
                [
                    'label' => 'IPV(401)',
                    'attribute' => 'ipv',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Cwebclient::displayEpi($data, 'ipv');
                    },
                ],
                [
                    'label' => 'แผนที่',
                    'visible' => 0,
                    'format' => 'raw',
                    'value' => function() {
                        return '<span class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> แสดงแผนที่</span>';
                    },
                ],
            ],
        ]);
        ?>
        <?php #yii\widgets\Pjax::end()       ?>
    </div>
</div>
