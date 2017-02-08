<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Chospital;
#use miloschuman\highcharts\Highcharts;
use app\modules\webclient\components\Cwebclient;
use yii\widgets\Pjax;

$this->title = 'รายชื่อเป้าหมายคัดกรองโรคความดันโลหิตสูง อายุ 35 ปีขึ้นไป ในเขตรับผิดชอบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['id' => 'gdData', 'timeout' => false, 'enablePushState' => false,]) ?>
<div>
    <?php
    $y = date('Y') - 2;
    $s = date('Y') + 2;
    for ($y; $y < $s; $y++) {
        $byear[$y] = $y + 543;
    }
    #current budgetyear
    if ((int) date('Ym') >= (int) (date('Y') . '10') OR (int) date('Ym') >= (int) (date('Y') . '11')OR (int) date('Ym') >= (int) (date('Y') . '12')) {
        $budgetyear = date('Y') + 1;
    } else {
        $budgetyear = date('Y');
    }

    $provcode = \Yii::$app->params['provcode'];
    $dataselect = (isset($_GET['q_hospcode']) ? $_GET['q_hospcode'] : '');

    if (strlen(\Yii::$app->params['ampcode']) == 4) {
        $ampcode = " and concat(provcode,distcode) = '" . \Yii::$app->params['ampcode'] . "' ";
    } else {
        $ampcode = '';
    }

    #if (!\Yii::$app->user->can('super_admin') && !\Yii::$app->user->can('ADMIN-AMP')) {
    #$sqlStringAdd = " and hoscode='{$dataselect}' ";
    #}

    $data = Chospital::find()->where("hostype in ('03','05','06','07','18') $ampcode and provcode = '{$provcode}' {$sqlStringAdd}")->orderBy('hoscode')->all();
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-heartbeat" style="color: #1E8000;"></i> <b>ผลการคัดกรองโรคความดันโลหิตสูง</b>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-users"></i></span>
                                <div class="info-box-content">
                                    <p style="font-size: 10px;">
                                        <span class="info-box-text"> <b style="font-size: 18px;">เป้าหมาย</b> <br>
                                            <span style="font-size: 25px;"><b> <?= @number_format($target['target']) ?>
                                                </b></span><span style="font-size: 10px;"> คน</span>
                                            <br>
                                        </span>
                                        <span style="font-size: 14px;">15-34 ปี&nbsp;&nbsp;&nbsp;&nbsp;  <b> <?= @number_format($target['age0']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                        <br>
                                        <span style="font-size: 14px;">35-59 ปี&nbsp;&nbsp;&nbsp;&nbsp;  <b> <?= @number_format($target['age1']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                        <br>
                                        <span style="font-size: 14px;">60 ปีขึ้นไป&nbsp;&nbsp;  <b> <?= @number_format($target['age2']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-list-ul"></i></span>
                                <div class="info-box-content">
                                    <p style="font-size: 10px;">
                                        <span class="info-box-text"> <b style="font-size: 18px;">คัดกรองแล้ว</b> <br>
                                            <span style="font-size: 25px;"><b> <?= @number_format($target['result']) ?></b></span><span style="font-size: 10px;"> คน</span>&nbsp;<span style="font-size: 25px;"><?= @number_format((($target['result'] * 100) / $target['target']), 2) ?>%</span>
                                        </span>
                                        <span style="font-size: 14px;">15-34 ปี&nbsp;&nbsp;&nbsp;&nbsp;  <b> <?= @number_format($target['result0']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                        <br>
                                        <span style="font-size: 14px;">35-59 ปี&nbsp;&nbsp;&nbsp;&nbsp;  <b> <?= @number_format($target['result1']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                        <br>
                                        <span style="font-size: 14px;">60 ปีขึ้นไป&nbsp;&nbsp;  <b> <?= @number_format($target['result2']) ?></b></span><span style="font-size: 10px;"> คน</span>

                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-pie-chart"></i></span>
                                <div class="info-box-content">
                                    <p style="font-size: 10px;">
                                        <span class="info-box-text"> <b style="font-size: 18px;">พบความเสี่ยง</b> <br>
                                            <span style="font-size: 25px;"><b> <?= @number_format($target['risk']) ?></b></span><span style="font-size: 10px;"> คน</span> <span style="font-size: 25px;"><?= @number_format((($target['risk'] * 100) / $target['result']), 2) ?>%</span>
                                            <br>
                                            <span style="font-size: 14px;">เสี่ยง&nbsp;&nbsp;&nbsp;&nbsp;  <b> <?= @number_format($target['risk1']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                            <br>
                                            <span style="font-size: 14px;">เสี่ยงสูง&nbsp; <b> <?= @number_format($target['risk2']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 hidden">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-get-pocket"></i></span>
                                <div class="info-box-content">
                                    <p style="font-size: 10px;">
                                        <span class="info-box-text"> <b style="font-size: 18px;">มีผลการตรวจน้ำตาลในเลือด</b> <br>
                                            <span style="font-size: 25px;"><b> <?= @number_format($target['bslevel']) ?>
                                                </b></span><span style="font-size: 10px;"> คน</span>
                                            <br><span style="font-size: 20px;"><?= @number_format((($target['bslevel'] * 100) / $target['result']), 2) ?> %</span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?=
    GridView::widget([
        'export' => [
            #'fontAwesome' => true,
            'showConfirmAlert' => false,
            'target' => GridView::TARGET_BLANK,
            'label' => 'ส่งออกรายงาน',
        ],
        'exportConfig' => [
            GridView::EXCEL => ['label' => 'บันทึกเป็น EXCEL'],
        ],
        #'pjax' => true,
        'responsiveWrap' => false,
        #'floatHeader' => true,
        'layout' => '<div class="box box-success">
        <div class="box-header with-border">
        <i class="fa fa-fw fa-list-ul" style="color: #1E8000;"></i> <b>' . $this->title . '</b>
        <div class="box-tools pull-right">{summary}</div>
        </div>
        <div class="box-body">

        <div class="btn-group" role="group" aria-label="">
        <form class="navbar-form navbar-left" method="GET" role="search" data-pjax="true">
          <div class="form-group">
          <div class="input-group">
          <div class="input-group-addon bg-yellow disabled color-palette"><i class="fa fa-fw fa-search"></i></div>
          ' . Html::textInput('q_search', $_GET['q_search'], ['class' => 'form-control input-sm', 'style' => 'width:100px;', 'placeholder' => 'ค้นหารายชื่อ-เลข 13 หลัก']) . '
          </div>
          ' . Html::dropDownList('q_hospcode', $dataselect, \yii\helpers\ArrayHelper::map($data, 'hoscode', 'fullname'), ['class' => 'form-control input-sm', 'style' => 'width:200px;', 'prompt' => ' ++เลือกทุกสถานบริการ++']) . '

          <input value="' . $_GET['q_screentype'] . '" name="q_screentype" type="hidden">
          <button type="submit" class="btn btn-success btn-sm">ตกลง</button>

           </div>
          </form>
           </div>
          <small>{toolbar}</small>{items}{pager}

</div>
</div>',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ผลงาน',
                'attribute' => 'date_screen',
                'format' => 'raw',
                'value' => function($data) {
                    $result = '';
                    if ($data['date_screen'] <> '') {
                        $result = 'คัดกรองแล้ว'; #Cwebclient::getThaiDate($data['date_serv']);
                        $color = 'success';
                    } else {
                        $result = '-';
                        $color = 'default';
                    }

                    return "<button class='btn btn-xs btn-{$color} col-md-12'>" . $result . "</button>";
                },
            ],
            [
                'label' => '#',
                'attribute' => 'risk',
                'format' => 'raw',
                'value' => function($data) {
                    $result = '';
                    if ($data['risk'] == 0 && $data['date_screen'] <> '') {
                        $result = 'ปกติ';
                        $color = 'info';
                    } else if ($data['risk'] == 1 && $data['date_screen'] <> '') {
                        $result = 'เสี่ยง';
                        $color = 'warning';
                    } else if ($data['risk'] == 2 && $data['date_screen'] <> '') {
                        $result = 'เสี่ยงสูง';
                        $color = 'danger';
                    } else {
                        $result = '-';
                        $color = 'default';
                    }

                    return "<button class='btn btn-xs btn-{$color} col-md-12'>" . $result . "</button>";
                },
            ],
            [
                'label' => 'ชื่อ-สกุล',
                'attribute' => 'person_name',
                'format' => 'raw',
                'value' => function($data) {
                    return $data['cid'] . '<br><small>' . $data['person_name'] . '</small>';
                }
            ],
            [
                'label' => 'PID',
                'attribute' => 'pid',
            ],
            [
                'label' => 'อายุ',
                'attribute' => 'age_y',
            ],
            [
                'label' => 'SBP',
                'attribute' => 'sbp',
                'format' => ['decimal', 0],
            ],
            [
                'label' => 'DBP',
                'attribute' => 'dbp',
                'format' => ['decimal', 0],
            ],
            [
                'label' => 'วันที่ได้รับการคัดกรอง',
                'attribute' => 'date_screen',
                'format' => 'raw',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['date_screen']);
                }
            ],
        ],
    ]);
    ?>

</div>
<?php Pjax::end(); ?>