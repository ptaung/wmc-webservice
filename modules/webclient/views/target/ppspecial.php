<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = 'รายชื่อเป้าหมายคัดกรองพัฒนาการเด็กตามกลุ่มอายุ specialpp ' . (isset($_GET['q_byear']) ? 'ช่วงคัดกรองวันที่ ' . Cwebclient::getThaiDate($birth[0]) . ' ถึง ' . Cwebclient::getThaiDate($birth[1]) : '');
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
    $url = yii\helpers\Url::to(['target/ppspecialdetail']);
    $this->registerJs(
            "$('.detail-view-link').click(function() {
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
      $('#pp-modal').modal();
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
                    <i class="fa fa-fw fa-heartbeat" style="color: #1E8000;"></i> <b>ผลงานการคัดกรองพัฒนาการเด็กตามกลุ่มอายุ specialpp</b>
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
                        <div class="col-md-6 ">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> <b style="font-size: 18px;">เป้าหมาย</b></span>
                                    <span style="font-size: 14px;">9 เดือน&nbsp;&nbsp;&nbsp;&nbsp;<b> <?= @number_format($target['age9']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                    <br>
                                    <span style="font-size: 14px;">18 เดือน&nbsp;&nbsp;&nbsp;<b> <?= @number_format($target['age18']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                    <br>
                                    <span style="font-size: 14px;">30 เดือน&nbsp;&nbsp;<b> <?= @number_format($target['age30']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                    <br>
                                    <span style="font-size: 14px;">42 เดือน&nbsp;&nbsp;<b> <?= @number_format($target['age42']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-users"></i></span>
                                <div class="info-box-content">

                                    <span class="info-box-text"> <b style="font-size: 18px;">ผลงาน</b></span>
                                    <span style="font-size: 14px;">9 เดือน&nbsp;&nbsp;&nbsp;&nbsp;<b> <?= @number_format($target['s_age9']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                    <br>
                                    <span style="font-size: 14px;">18 เดือน&nbsp;&nbsp;&nbsp;<b> <?= @number_format($target['s_age18']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                    <br>
                                    <span style="font-size: 14px;">30 เดือน&nbsp;&nbsp;<b> <?= @number_format($target['s_age30']) ?></b></span><span style="font-size: 10px;"> คน</span>
                                    <br>
                                    <span style="font-size: 14px;">42 เดือน&nbsp;&nbsp;<b> <?= @number_format($target['s_age42']) ?></b></span><span style="font-size: 10px;"> คน</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-warning">
        <div class="box-header with-border">
            <i class="fa fa-fw fa-heartbeat" style="color: #1E8000;"></i> <b>คำอธิบาย</b>
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
            <div>
                หมายเหตุ ::
                <br>- เป้าหมายในปีงบประมาณ คือ เด็กจะต้องมีวันที่วันแรกที่อายุแตะ 9,18,30,42 เดือน ในปีงบประมาณนั้นๆ
                <br>- เป้าหมายในแต่ละเดือน คือ เด็กที่วันที่วันแรกที่อายุแตะ 9,18,30,42 เดือนในเดือนนั้นๆ

                <br>- การคัดกรองเด็กแต่ละช่วงอายุ จะมีเวลาที่ทำได้ คือ ภายใน 30 วันหลังจากเด็กอายุแตะ 9,18,30,42 เดือน
                เช่น เด็กอายุครบ 18 เดือนพอดีในวันที่ 1 กค. ท่านคักรองเด็กได้ตั้งแต่วันที่ 1 กค. ถึงวันที่ 30 กค. เท่านั้น หากเกินจากนี้เด็กจะอายุ 19 เดือนเต็ม ซึ่งไม่ใช่เป้าหมายการคัดกรอง

                <br>- ผลงานระบบจะติดตามไปตรวจสอบให้ 30 วันหลังจาก วันที่เด็กอายุแตะ 9,18,30,42 เดือน แล้วนำผลมาใส่ในเดือนที่เป็นเป้าหมาย ถึงแม้จะคนละเดือนกัน
                <br>- กรณีติดตาม/ส่งต่อ ระบบจะตามต่ออีก 30 วันจากวันที่ตรวจครั้งแรก แล้วนำผลมาใส่ในเดือนที่เป็นเป้าหมายเช่นกัน

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
                        $result = 'นับผลงาน';
                        $color = 'success';
                    } else {
                        $result = '-';
                        $color = 'default';
                    }

                    return "<button class='btn btn-xs btn-{$color} col-md-12'>" . $result . "</button>";
                },
            ],
            /*  [
              'label' => 'Lookup',
              'attribute' => 'lookuptarget',
              ],
             *
             */
            [
                'label' => '#',
                #'attribute' => 'person_name',
                'format' => 'raw',
                'value' => function($data, $key, $index, $column) {
                    return yii\helpers\Html::a('<span class="glyphicon glyphicon-expand"></span>', '#', [
                                'class' => 'detail-view-link',
                                'title' => Yii::t('yii', 'ตรวจสอบการบันทึก'),
                                'data-toggle' => 'modal',
                                'data-target' => '#pp-modal',
                                'data-id' => $data['cid'],
                                'data-pjax' => '0',
                    ]);
                }
                    ],
                    [
                        'label' => 'เลขบัตรประชาชน',
                        'attribute' => 'cid',
                        'format' => 'raw',
                        'value' => function($data) {
                            return '<small>' . $data['cid'] . '</small>';
                        }
                    ],
                    [
                        'label' => 'ชื่อ-สกุล',
                        'attribute' => 'person_name',
                        'format' => 'raw',
                        'value' => function($data) {
                            return '<small>' . $data['person_name'] . '</small>';
                        }
                    ],
                    [
                        'label' => 'PID',
                        'attribute' => 'pid',
                        'format' => 'raw',
                        'value' => function($data) {
                            return '<small>' . $data['pid'] . '</small>';
                        }
                    ],
                    [
                        'label' => 'วันเกิด',
                        'attribute' => 'birth',
                        'format' => 'raw',
                        'value' => function($data) {
                            return '<small>' . Cwebclient::getThaiDate($data['birth']) . '</small>';
                        }
                    ],
                    [
                        'label' => 'อายุ(เดือน)',
                        'attribute' => 'agemonth',
                    ],
                    [
                        'label' => 'วันที่เริ่มคัดกรองได้',
                        'attribute' => 'date_start',
                        'contentOptions' => [
                            'class' => 'bg-success'
                        ],
                        'hAlign' => 'center',
                        'format' => 'raw',
                        'value' => function($data) {
                    return ($data['date_start'] <> '' ? '<small>' . Cwebclient::getThaiDate($data['date_start']) . '</small>' : '');
                }
                    ],
                    [
                        'label' => 'วันที่สิ้นสุดคัดกรอง',
                        'attribute' => 'date_end',
                        'hAlign' => 'center',
                        'contentOptions' => [
                            'class' => 'bg-success'
                        ],
                        'format' => 'raw',
                        'value' => function($data) {
                    return ($data['date_end'] <> '' ? '<small>' . Cwebclient::getThaiDate($data['date_end']) . '</small>' : '');
                }
                    ],
                    [
                        'label' => 'อยู่ในช่วงคัดกรอง',
                        'attribute' => 'mustscreen',
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'วันที่คัดกรองครั้งแรก',
                        'attribute' => 'date_serv_first',
                        'format' => 'raw',
                        'value' => function($data) {
                            return ($data['date_serv_first'] <> '' ? '<small>' . Cwebclient::getThaiDate($data['date_serv_first']) . '</small>' : '');
                        }
                    ],
                    [
                        'label' => 'ผลประเมิน',
                        'attribute' => 'status1',
                        'format' => 'raw',
                        'value' => function($data) {
                            if ($data['status1'] == '1') {
                                $return = 'ปกติ';
                            } else if ($data['status1'] == '2') {
                                $return = 'สงสัยล่าช้า';
                            } else if ($data['status1'] == '3') {
                                $return = 'ส่งต่อ';
                            } else {
                                $return = '';
                            }

                            return "<small>{$return}</small>";
                        }
                    ],
                    [
                        'label' => 'วันที่ติดตามกรณีสงสัยล่าช้า',
                        'attribute' => 'date_serv2',
                        'format' => 'raw',
                        'value' => function($data) {
                            return ($data['date_serv2'] <> '' ? '<small>' . Cwebclient::getThaiDate($data['date_serv2']) . '</small>' : '');
                        }
                    ],
                ],
            ]);
            ?>
        </div>
        <?php Pjax::end(); ?>

        <?php
        Modal::begin([
            'id' => 'pp-modal',
            'size' => 'modal-lg',
            'header' => '<h4 class="modal-title">การได้รับคัดกรอง <span id="cid-html"></span></h4>',
            'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
        ]);
        ?>
        <?php Modal::end(); ?>