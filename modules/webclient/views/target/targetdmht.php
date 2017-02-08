<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Chospital;
use miloschuman\highcharts\Highcharts;
use yii\widgets\Pjax;

$this->title = 'รายชื่อเป้าหมายผู้ป่วยเบาหวานความดันในเขตรับผิดชอบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['id' => 'gdData', 'timeout' => false, 'enablePushState' => false,]) ?>
<div>
    <?php
    #echo date('H:i:s');

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
        $ampcode = " and hoscode in($ampFilter)";
    }

    #if (!\Yii::$app->user->can('super_admin') && !\Yii::$app->user->can('ADMIN-AMP')) {
    #$sqlStringAdd = " and hoscode='{$dataselect}' ";
    #}

    $data = Chospital::find()->where("hostype in ('03','05','06','07','18' ) $ampcode and provcode = '{$provcode}' {$sqlStringAdd}")->orderBy('hoscode')->all();
    ?>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-list" style="color: #1E8000;"></i> <b>สัดส่วนเป้าหมาย</b>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    echo Highcharts::widget([
                        'scripts' => [
                            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                        ],
                        'options' => [
                            'chart' => [
                                'type' => 'bar',
                                'height' => '100',
                            ],
                            'plotOptions' => [
                                'series' => ['stacking' => 'percent'],
                            #'column' => ['stacking' => 'percent']
                            ],
                            'colors' => ['#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
                            'title' => ['text' => ''],
                            'xAxis' => [
                                'categories' => ['เป้าหมาย']
                            #'type' => 'category'
                            ],
                            'legend' => [
                                'enabled' => false,
                            #'reversed' => true
                            ],
                            'yAxis' => [
                                'title' => ['text' => ''], 'min' => 0
                            ],
                            'credits' => ['enabled' => false],
                            'series' => [
                                [
                                    'name' => 'WMC',
                                    'data' => [$target['WMC']]
                                ],
                                [
                                    'name' => 'WMC,HDC',
                                    'data' => [$target['WMC,HDC']]
                                ],
                                [
                                    'name' => 'HDC',
                                    'data' => [$target['HDC']]
                                ],
                            ]
                        ]
                    ]);
                    ?>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-user" style="color: #1E8000;"></i> <b>สัดส่วนผู้ป่วย</b>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body">

                    <?php
                    echo Highcharts::widget([
                        'scripts' => [
                            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                        ],
                        'options' => [
                            'chart' => [
                                'type' => 'bar',
                                'height' => '100',
                            ],
                            'plotOptions' => [
                                'series' => ['stacking' => 'percent'],
                            #'column' => ['stacking' => 'percent']
                            ],
                            'colors' => ['#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
                            'title' => ['text' => ''],
                            'xAxis' => [
                                'categories' => ['ผู้ป่วย']
                            #'type' => 'category'
                            ],
                            'legend' => [
                                'enabled' => false,
                            #'reversed' => true
                            ],
                            'yAxis' => [
                                'title' => ['text' => ''], 'min' => 0
                            ],
                            'credits' => ['enabled' => false],
                            'series' => [
                                [
                                    'name' => 'DM',
                                    'data' => [$target['DM']]
                                ],
                                [
                                    'name' => 'DM,HT',
                                    'data' => [$target['DM,HT']]
                                ],
                                [
                                    'name' => 'HT',
                                    'data' => [$target['HT']]
                                ],
                            ]
                        ]
                    ]);
                    ?>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-heartbeat" style="color: #1E8000;"></i> <b>ผลงาน</b>
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
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-pie-chart"></i></span>
                                <div class="info-box-content">
                                    <p style="font-size: 10px;">
                                        <span class="info-box-text"> <b style="font-size: 18px;">คุมระดับน้ำตาล</b> <br>
                                            <span style="font-size: 25px;"><b> <?= @number_format($target['dm_control']) ?></b></span><span style="font-size: 10px;"> คน เป้า</span> <span style="font-size: 25px;"><b> <?= @number_format(($target['DM,HT'] + $target['DM']), 0) ?></b></span><span style="font-size: 10px;"> คน</span>
                                            <br><span style="font-size: 20px;"><?= @number_format((($target['dm_control'] * 100) / ($target['DM,HT'] + $target['DM'])), 2) ?> %</span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-pie-chart"></i></span>
                                <div class="info-box-content">
                                    <p style="font-size: 10px;">
                                        <span class="info-box-text"> <b style="font-size: 18px;">คุมความดันสูง</b> <br>
                                            <span style="font-size: 25px;"><b> <?= @number_format($target['ht_control']) ?>
                                                </b></span><span style="font-size: 10px;"> คน เป้า</span> <span style="font-size: 25px;"><b> <?= @number_format(($target['DM,HT'] + $target['HT']), 0) ?></b></span><span style="font-size: 10px;"> คน</span>
                                            <br><span style="font-size: 20px;"><?= @number_format((($target['ht_control'] * 100) / ($target['DM,HT'] + $target['HT'])), 2) ?> %</span>

                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-eye"></i></span>
                                <div class="info-box-content">
                                    <p style="font-size: 10px;">
                                        <span class="info-box-text"> <b style="font-size: 18px;">การตรวจตา</b> <br>
                                            <span style="font-size: 25px;"><b> <?= @number_format($target['eye']) ?>
                                                </b></span><span style="font-size: 10px;"> คน เป้า</span> <span style="font-size: 25px;"><b> <?= @number_format(($target['DM,HT'] + $target['DM']), 0) ?></b></span><span style="font-size: 10px;"> คน</span>
                                            <br><span style="font-size: 20px;"><?= @number_format((($target['eye'] * 100) / ($target['DM,HT'] + $target['DM'])), 2) ?> %</span>

                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-universal-access"></i></span>
                                <div class="info-box-content">
                                    <p style="font-size: 10px;">
                                        <span class="info-box-text"> <b style="font-size: 18px;">การตรวจเท้า</b> <br>
                                            <span style="font-size: 25px;"><b> <?= @number_format($target['foot']) ?>
                                                </b></span><span style="font-size: 10px;"> คน</span>
                                            <br><span style="font-size: 20px;"><?= @number_format((($target['foot'] * 100) / ($target['DM,HT'] + $target['DM'])), 2) ?> %</span>

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
                ' . Html::dropDownList('q_byear', (isset($_GET['q_byear']) ? $_GET['q_byear'] : $budgetyear), $byear, ['class' => 'form-control input-sm', 'style' => 'width:80px;', 'prompt' => ' ++ปีงบประมาณ++']) . '
                ' . Html::dropDownList('q_chronic', (isset($_GET['q_chronic']) ? $_GET['q_chronic'] : $_GET['q_chronic']), ['02' => 'DM', '01' => 'HT', '03' => 'DMHT'], ['class' => 'form-control input-sm', 'prompt' => '++สถานะการเป็นโรค++']) . '
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
                'label' => '#',
                'attribute' => 'follow_up',
                'format' => 'raw',
                'value' => function($data) {
                    $result = '';
                    if ($data['follow_up'] == 1) {
                        $result = 'ต้องขึ้นทะเบียน';
                        $color = 'warning';
                    } else {
                        $result = '-';
                        $color = 'success';
                    }

                    return "<span class='btn btn-{$color} btn-xs col-md-12' style=width:100%;>" . $result . "</span>";
                },
            ],
            [
                'label' => 'Lookup',
                'attribute' => 'lookuptarget',
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
                'label' => 'TypeArea',
                'attribute' => 'typearea',
                'visible' => 0,
            ],
            [
                'label' => 'อ้างอิง Hosxp',
                'attribute' => 'typearea',
                'visible' => 0,
            ],
            [
                'label' => 'อายุ',
                'attribute' => 'age_y',
            ],
            [
                'label' => 'แหล่งข้อมูล',
                'attribute' => 'source_tb',
                'format' => 'raw',
                'value' => function($data) {
                    return '<small>ที่มา ' . $data['source_tb'] . "<br>HOS-DX " . $data['hosp_dx'] . '</small>';
                }
            ],
            [
                'label' => 'การเป็นโรค',
                'attribute' => 't_mix_dx_title',
                'format' => 'raw',
                'value' => function($data) {
                    return '<small>' . $data['t_mix_dx_title'] . '</small>';
                }
            ],
            [
                'label' => 'คุมระดับน้ำตาล',
                'attribute' => 'dm_control',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data['dm_control'] == 1) {
                        $result = 'คุมได้';
                        $color = 'info';
                    } else {
                        $result = '-';
                        $color = 'default';
                    }
                    return "<button class='btn btn-xs btn-{$color} col-md-12'>" . $result . "</button>";
                }
            ],
            [
                'label' => 'ผล Hba1c',
                'attribute' => 'rs_hba1c_result',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data['rs_hba1c_result'] <> '') {
                        if ($data['rs_hba1c_result'] >= 7) {
                            $color = 'danger';
                        } else {

                            $color = 'success';
                        }
                        $result = 'HBA1C ' . $data['rs_hba1c_result'];
                    } else {
                        $result = '-';
                        $color = 'default';
                    }
                    return "<button class='btn btn-xs btn-{$color} col-md-12' title='" . $data['rs_hba1c_result'] . '|' . $data['ld_hba1c_result'] . '|' . $data['ih_hba1c_result'] . "'>" . $result . "</button>";
                }
            ],
            [
                'label' => 'คุมความดันสูง',
                'attribute' => 'ht_control',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data['ht_control'] == 1) {
                        $result = 'คุมได้';
                        $color = 'info';
                    } else {
                        $result = '-';
                        $color = 'default';
                    }
                    return "<button class='btn btn-xs btn-{$color} col-md-12'>" . $result . "</button>";
                }
            ],
            /*
              [
              'label' => 'FPG1',
              'attribute' => 'ld_fpg1_result',
              'format' => 'raw',
              'value' => function($data) {
              if ($data['ld_fpg1_result'] <> '') {
              $result = 'FPG1 ' . $data['rs_fpg1_result'];
              $color = 'info';
              } else {
              $result = '-';
              $color = 'default';
              }
              return "<button class='btn btn-xs btn-{$color} col-md-12' title='" . $data['rs_fpg1_result'] . '|' . $data['ld_fpg1_result'] . '|' . $data['ih_fpg1_result'] . "'>" . $result . "</button>";
              }
              ],
              [
              'label' => 'FPG2',
              'attribute' => 'ld_fpg2_result',
              'format' => 'raw',
              'value' => function($data) {
              if ($data['ld_fpg2_result'] <> '') {
              $result = 'FPG2 ' . $data['rs_fpg2_result'];
              $color = 'info';
              } else {
              $result = '-';
              $color = 'default';
              }
              return "<button class='btn btn-xs btn-{$color} col-md-12' title='" . $data['rs_fpg2_result'] . '|' . $data['ld_fpg2_result'] . '|' . $data['ih_fpg2_result'] . "'>" . $result . "</button>";
              }
              ],
             *
             */
            [
                'label' => 'วันที่ตรวจ Hba1c ล่าสุด',
                'attribute' => 'ld_hba1c_result',
                'visible' => 0
            ],
            [
                'label' => 'BP ครั้งที่ 1',
                'attribute' => 'bp1_result',
            ],
            [
                'label' => 'BP ครั้งที่ 2',
                'attribute' => 'bp2_result',
            ],
            [
                'label' => 'ตรวจตา',
                'attribute' => 'ld_retina_result',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data['ld_retina_result'] <> '') {
                        $result = 'ตรวจตา'; #"<span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span>"
                        $color = 'info';
                    } else {
                        $result = '-';
                        $color = 'default';
                    }
                    return "<button class='btn btn-xs btn-{$color} col-md-12' title='" . $data['rs_retina_result'] . '|' . $data['ld_retina_result'] . '|' . $data['ih_retina_result'] . "'>" . $result . "</button>";
                }
            ],
            [
                'label' => 'ตรวจเท้า',
                'attribute' => 'ld_foot_result',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data['ld_foot_result'] <> '') {
                        $result = 'ตรวจเท้า';
                        $color = 'info';
                    } else {
                        $result = '-';
                        $color = 'default';
                    }
                    return "<button class='btn btn-xs btn-{$color} col-md-12' title='" . $data['rs_foot_result'] . '|' . $data['ld_foot_result'] . '|' . $data['ih_foot_result'] . "'>" . $result . "</button>";
                }
            ],
            [
                'label' => 'นับผลงาน',
                'attribute' => 'result',
                'format' => 'raw',
                'visible' => 0,
                'value' => function($data) {
                    $result = '';
                    if ($data['result'] == 1) {
                        $result = 'ครบตามเกณฑ์'; #Cwebclient::getThaiDate($data['date_serv']);
                        $color = '#009900';
                    } else {
                        $result = 'ยังไม่รับบริการ';
                        $color = '#C0C0C0';
                    }

                    return "<span class='btn btn-xs col-md-12' style='background:{$color}';width:100%;>" . $result . "</span>";
                },
            ],
        ],
    ]);
    ?>

</div>
<?php Pjax::end(); ?>


