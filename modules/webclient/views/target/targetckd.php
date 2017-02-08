<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;
use yii\widgets\Pjax;

$this->title = 'รายชื่อเป้าหมายผู้ป่วยเบาหวานความดันในเขตรับผิดชอบที่ได้รับการค้นหาและคัดกรองโรคไตเรื้อรัง';
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
    /*
      if (isset($_GET['q_hospcode']))
      echo app\modules\webclient\components\Cmapclient::widget(['point' => $point, 'zoom' => 14, 'height' => 300,
      # 'content' => '<br>ความพิการ {person_deformed_type_name}'
      'icon' => 'https://cdn3.iconfinder.com/data/icons/user-icons/32/Baby_32.png']);
     *
     */
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-heartbeat" style="color: #1E8000;"></i> <b>ผลการตรวจ LAB</b>
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
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-get-pocket"></i></span>
                                <div class="info-box-content">
                                    <p style="font-size: 10px;">
                                        <span class="info-box-text"> <b style="font-size: 18px;">Creatinine</b> <br>
                                            <span style="font-size: 25px;"><b> <?= @number_format($target['creatinine']) ?>
                                                </b></span><span style="font-size: 10px;"> คน</span>
                                            <br><span style="font-size: 20px;"><?= @number_format((($target['creatinine'] * 100) / $target['target']), 2) ?> %</span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-get-pocket"></i></span>
                                <div class="info-box-content">
                                    <p style="font-size: 10px;">
                                        <span class="info-box-text"> <b style="font-size: 18px;">microalbumin</b> <br>
                                            <span style="font-size: 25px;"><b> <?= @number_format($target['microalbumin']) ?>
                                                </b></span><span style="font-size: 10px;"> คน</span>
                                            <br><span style="font-size: 20px;"><?= @number_format((($target['microalbumin'] * 100) / $target['target']), 2) ?> %</span>

                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-get-pocket"></i></span>
                                <div class="info-box-content">
                                    <p style="font-size: 10px;">
                                        <span class="info-box-text"> <b style="font-size: 18px;">macroalbumin</b> <br>
                                            <span style="font-size: 25px;"><b> <?= @number_format($target['macroalbumin']) ?>
                                                </b></span><span style="font-size: 10px;"> คน</span>
                                            <br><span style="font-size: 20px;"><?= @number_format((($target['macroalbumin'] * 100) / $target['target']), 2) ?> %</span>

                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon info-box-icon bg-teal"><i class="fa fa-fw fa-get-pocket"></i></span>
                                <div class="info-box-content">
                                    <p style="font-size: 10px;">
                                        <span class="info-box-text"> <b style="font-size: 18px;">eGFR</b> <br>
                                            <span style="font-size: 25px;"><b> <?= @number_format($target['egfr']) ?>
                                                </b></span><span style="font-size: 10px;"> คน</span>
                                            <br><span style="font-size: 20px;"><?= @number_format((($target['egfr'] * 100) / $target['target']), 2) ?> %</span>
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
            <div> เป้าหมาย = ผู้ป่วยโรคเบาหวานและหรือความดันโลหิตสูงสัญชาติไทย ในเขตรับผิดชอบที่ไม่มีภาวะแทรกซ้อนทางไต

                ประมวลผลจาก ผู้ป่วยรหัสโรคเป็น (E10* ถึง E14*) ลบออกด้วย (E102, E112, E122, E132, E142)
                และ/หรือ มีรหัสโรคเป็น (I10* ถึง I15*) ลบออกด้วย (I12*, I13*,I151) และไม่มีรหัสโรค N181-189
                ******ผู้ป่วยที่มีภาวะแทรกซ้อนก่อนปีงบประมาณปัจจุบัน จึงจะนำมาหักออกเท่านั้น

                ผลงาน = ผู้ป่วยตาม เป้าหมาย ที่ได้รับการตรวจคัดกรอง คือ ตรวจ LABTEST12 หรือ LABTEST14 หรือ LABTEST11 หรือ LABTEST15

                โดยประเมินจากวันที่ตรวจในปีงบประมาณเท่านั้น (ไม่ดูผลการตรวจ)
                *******หากมีการตรวจ LAB มากกว่าหนึ่งรายการ จะนับเป็นผลงานในไตรมาสที่วันที่ตรวจน้อยที่สุดเพียงครั้งเดียวเท่านั้น

            </div>
        </div>
    </div>
    <?=
    GridView::widget([
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => '', 'options' => ['colspan' => 4, 'class' => 'text-center warning']],
                    ['content' => 'ตรวจ Creatinine ในเลือด', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                    ['content' => 'ตรวจโปรตีน microalbumin ในปัสสาวะ', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                    ['content' => 'ตรวจโปรตีน macroalbumin', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                    ['content' => 'ตรวจหาค่า eGFR', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                ],
            ],
        ],
        /*
          'panel' => [
          'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> ' . $this->title . '</h3>',
          'type' => 'default',
          'before' => '<div class="btn-group" role="group" aria-label="">'
          . '<form class="navbar-form navbar-left" method="GET" role="search" data-pjax="true">
          <div class="form-group">

          ' . Html::textInput('q_search', $_GET['q_search'], ['class' => 'form-control input-sm', 'placeholder' => 'ค้นหารายชื่อ-เลข 13 หลัก']) . '
          ' . Html::dropDownList('q_byear', (isset($_GET['q_byear']) ? $_GET['q_byear'] : date('Y')), $byear, ['class' => 'form-control input-sm', 'prompt' => ' ++ปีงบประมาณ++']) . '
          ' . Html::dropDownList('q_chronic', (isset($_GET['q_chronic']) ? $_GET['q_chronic'] : $_GET['q_chronic']), ['02' => 'DM', '01' => 'HT', '03' => 'DMHT'], ['class' => 'form-control input-sm', 'prompt' => '++สถานะการเป็นโรค++']) . '
          ' . Html::dropDownList('q_hospcode', $dataselect, \yii\helpers\ArrayHelper::map($data, 'hoscode', 'fullname'), ['class' => 'form-control input-sm', 'prompt' => ' ++เลือกสถานบริการ++']) . '
          </div>
          <input value="' . $_GET['q_screentype'] . '" name="q_screentype" type="hidden">
          <button type="submit" class="btn btn-success btn-sm">ตกลง</button>
          </form>'
          #. Html::textInput('byear', '', ['class' => 'btn btn-success'])
          #. Html::a('<i class="glyphicon glyphicon-refresh"></i> เบาหวาน', ['index'], ['class' => 'btn btn-success'])
          #. Html::a('<i class="glyphicon glyphicon-refresh"></i> ความดัน', ['index'], ['class' => 'btn btn-warning'])
          . '</div>',
          #'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
          #'footer' => true
          ],
         *
         */
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
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'เลขบัตรประชาชน',
                'attribute' => 'cid',
                'visible' => 0,
            ],
            /*
              [
              'label' => 'HN',
              'attribute' => 'hn',
              ],
              [
              'label' => 'ชื่อ-สกุล',
              'attribute' => 'person_name',
              ],
             *
             */
            [
                'label' => 'ชื่อ-สกุล',
                'attribute' => 'person_name',
                'format' => 'raw',
                'value' => function($data) {
                    return $data['hn'] . '<br><small>' . $data['person_name'] . '</small>';
                }
            ],
            [
                'label' => 'อายุ',
                'attribute' => 'age_y',
            ],
            [
                'label' => 'วันที่ตรวจ',
                'attribute' => 'lab11_date',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['lab11_date']);
                }
            ],
            [
                'label' => 'ค่า Lab',
                'attribute' => 'lab11_result',
            ],
            [
                'label' => 'หน่วยบริการ',
                'attribute' => 'lab11_hosp',
            ],
            [
                'label' => 'วันที่ตรวจ',
                'attribute' => 'lab12_date',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['lab12_date']);
                }
            ],
            [
                'label' => 'ค่า Lab',
                'attribute' => 'lab12_result',
            ],
            [
                'label' => 'หน่วยบริการ',
                'attribute' => 'lab12_hosp',
            ],
            [
                'label' => 'วันที่ตรวจ',
                'attribute' => 'lab14_date',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['lab14_date']);
                }
            ],
            [
                'label' => 'ค่า Lab',
                'attribute' => 'lab14_result',
            ],
            [
                'label' => 'หน่วยบริการ',
                'attribute' => 'lab14_hosp',
            ],
            [
                'label' => 'วันที่ตรวจ',
                'attribute' => 'lab15_date',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['lab15_date']);
                }
            ],
            [
                'label' => 'ค่า Lab',
                'attribute' => 'lab15_result',
            ],
            [
                'label' => 'หน่วยบริการ',
                'attribute' => 'lab15_hosp',
            ],
        ],
    ]);
    ?>
</div>
<?php Pjax::end(); ?>