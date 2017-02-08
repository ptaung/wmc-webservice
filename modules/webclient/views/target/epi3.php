<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = 'รายชื่อเป้าหมายความครอบคลุมของเด็กอายุครบ 3 ปี ' . (isset($_GET['q_byear']) ? 'ช่วงเด็กเกิดวันที่ ' . Cwebclient::getThaiDate($birth[0]) . ' ถึง ' . Cwebclient::getThaiDate($birth[1]) : '');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['id' => 'gdData', 'timeout' => false, 'enablePushState' => false,]) ?>
<div class="menu-group-index">
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

    $data = Chospital::find()->where("hostype in ('03','05','06','07','18' ) $ampcode and provcode = '{$provcode}' {$sqlStringAdd}")->orderBy('hoscode')->all();
    ?>

    <?php
    $url = yii\helpers\Url::to(['target/epi3detail']);
    $this->registerJs(
            "$('.epi-view-link').click(function() {
                    var cid = $(this).data('id');
                    $('.modal-body').html('<p>กำลังเรียกข้อมูลของ '+cid+'</p>');
                    $.get(
                        '" . $url . "',
                        {
                            cid: $(this).data('id')
                        },
                        function (d) {
                            $('#cid-html').html(cid);
                            $('.modal-body').html(d);
                            $('#epi-modal').modal();
                        }
                    );
                });
    "
    );
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-heartbeat" style="color: #1E8000;"></i> <b>ผลงานการเก็บความครอบคลุมของเด็กอายุครบ 3 ปีที่ได้รับวัคซีน JE MMR2</b>
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
                        <div class="col-md-4 hidden">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> <b style="font-size: 18px;">ผลงาน</b> <br>
                                        <span style="font-size: 25px;"><b> <?= @number_format($target['result']) ?>
                                            </b></span><span style="font-size: 10px;"> คน</span>
                                        <br>
                                        <span style="font-size: 14px;"><?= @number_format((($target['result'] * 100) / $target['target']), 2) ?>%</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> <b style="font-size: 18px;">MMR2</b> <br>
                                        <span style="font-size: 25px;"><b> <?= @number_format($target['mmr2']) ?>
                                            </b></span><span style="font-size: 10px;"> คน</span>
                                        <br>
                                    </span>
                                    <span style="font-size: 14px;"><?= @number_format((($target['mmr2'] * 100) / $target['target']), 2) ?>%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> <b style="font-size: 18px;">JE</b> <br>
                                        <span style="font-size: 25px;"><b> <?= @number_format($target['je']) ?>
                                            </b></span><span style="font-size: 10px;"> คน</span>
                                        <br>
                                        <span style="font-size: 14px;"><?= @number_format((($target['je'] * 100) / $target['target']), 2) ?>%</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        <b style="font-size: 18px;">เจอีเชื้อตาย</b> <br>
                                        <b style="font-size: 14px;">JE1</b> <span style="font-size: 14px;"><?= @number_format($target['je1']) ?> <span style="font-size: 10px;"> คน</span> <?= @number_format((($target['je1'] * 100) / $target['target']), 2) ?>%</span><br>
                                        <b style="font-size: 14px;">JE2</b> <span style="font-size: 14px;"><?= @number_format($target['je2']) ?> <span style="font-size: 10px;"> คน</span> <?= @number_format((($target['je2'] * 100) / $target['target']), 2) ?>%</span><br>
                                        <b style="font-size: 14px;">JE3</b> <span style="font-size: 14px;"><?= @number_format($target['je3']) ?> <span style="font-size: 10px;"> คน</span> <?= @number_format((($target['je3'] * 100) / $target['target']), 2) ?>%</span><br>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        <b style="font-size: 18px;">เจอีเชื้อเป็น</b> <br>
                                        <b style="font-size: 14px;">J11</b> <span style="font-size: 14px;"><?= @number_format($target['j11']) ?> <span style="font-size: 10px;"> คน</span> <?= @number_format((($target['j11'] * 100) / $target['target']), 2) ?>%</span><br>
                                        <b style="font-size: 14px;">J12</b> <span style="font-size: 14px;"><?= @number_format($target['j12']) ?> <span style="font-size: 10px;"> คน</span> <?= @number_format((($target['j12'] * 100) / $target['target']), 2) ?>%</span><br>
                                    </span>
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
        #GridView::PDF => ['label' => 'บันทึกเป็น PDF'],
        ],
        #'pjax' => true,
        'responsiveWrap' => false,
        #'floatHeader' => true,
        #'export' => false,
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
                'attribute' => 'point',
                'format' => 'raw',
                'value' => function($data) {
                    $result = '';
                    if ($data['point'] == '1') {
                        $result = 'ครบ';
                        $color = 'success';
                    } else {
                        $result = '-';
                        $color = 'default';
                    }

                    return "<button class='btn btn-xs btn-{$color} col-md-12'>" . $result . "</button>";
                },
            ],
            [
                'label' => 'Lookup',
                'attribute' => 'lookuptarget',
            ],
            [
                'label' => '#',
                #'attribute' => 'person_name',
                'format' => 'raw',
                'value' => function($data, $key, $index, $column) {
                    return yii\helpers\Html::a('<span class="glyphicon glyphicon-expand"></span>', '#', [
                                'class' => 'epi-view-link',
                                'title' => Yii::t('yii', 'View'),
                                'data-toggle' => 'modal',
                                'data-target' => '#epi-modal',
                                'data-id' => $data['cid'],
                                'data-pjax' => '0',
                    ]);
                }
                    ],
                    [
                        'label' => 'ชื่อ-สกุล',
                        'attribute' => 'person_name',
                        'format' => 'raw',
                        'value' => function($data) {
                            return '<b>' . $data['cid'] . '</b><br><small>' . $data['person_name'] . '</small>';
                        }
                    ],
                    [
                        'label' => 'PID',
                        'attribute' => 'pid',
                    ],
                    [
                        'label' => 'วันเกิด',
                        'attribute' => 'birth',
                        'format' => 'raw',
                        'value' => function($data) {
                            return Cwebclient::getThaiDate($data['birth']);
                        }
                    ],
                    [
                        'label' => '#',
                        'value' => function($data) {
                            return '';
                        }
                    ],
                    [
                        'label' => 'MMR2',
                        'attribute' => 'mmr2_date',
                        'format' => 'raw',
                        'value' => function($data) {
                            return ($data['mmr2_date'] <> '' ? '<small>' . Cwebclient::getThaiDate($data['mmr2_date']) . '</small>' : '');
                        }
                    ],
                    [
                        'label' => 'JE1',
                        'attribute' => 'je1_date',
                        'format' => 'raw',
                        'value' => function($data) {
                            return ($data['je1_date'] <> '' ? '<small>' . Cwebclient::getThaiDate($data['je1_date']) . '</small>' : '');
                        }
                    ],
                    [
                        'label' => 'JE2',
                        'attribute' => 'je2_date',
                        'format' => 'raw',
                        'value' => function($data) {
                            return ($data['je2_date'] <> '' ? '<small>' . Cwebclient::getThaiDate($data['je2_date']) . '</small>' : '');
                        }
                    ],
                    [
                        'label' => 'JE3',
                        'attribute' => 'je3_date',
                        'format' => 'raw',
                        'value' => function($data) {
                            return ($data['je3_date'] <> '' ? '<small>' . Cwebclient::getThaiDate($data['je3_date']) . '</small>' : '');
                        }
                    ],
                    [
                        'label' => 'J11',
                        'attribute' => 'j11_date',
                        'format' => 'raw',
                        'value' => function($data) {
                            return ($data['j11_date'] <> '' ? '<small>' . Cwebclient::getThaiDate($data['j11_date']) . '</small>' : '');
                        }
                    ],
                    [
                        'label' => 'J12',
                        'attribute' => 'j12_date',
                        'format' => 'raw',
                        'value' => function($data) {
                            return ($data['j12_date'] <> '' ? '<small>' . Cwebclient::getThaiDate($data['j12_date']) . '</small>' : '');
                        }
                    ],
                    [
                        'label' => 'หมายเหตุ',
                        'attribute' => 'etc',
                        'format' => 'raw',
                    ],
                ],
            ]);
            ?>
        </div>
        <?php Pjax::end(); ?>

        <?php
        Modal::begin([
            'id' => 'epi-modal',
            'size' => 'modal-lg',
            'header' => '<h4 class="modal-title">การได้รับวัคซีน <span id="cid-html"></span></h4>',
            'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
        ]);
        ?>
        <?php Modal::end(); ?>