<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;
use yii\widgets\Pjax;

$this->title = 'รายชื่อเป้าหมายหญิงตั้งครรภ์ฝากครรภ์ 5 ครั้ง ในเขตรับผิดชอบ';
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
                'attribute' => 'result',
                'format' => 'raw',
                'value' => function($data) {
                    $result = '';
                    if ($data['result'] == 1) {
                        $result = 'ครบ'; #Cwebclient::getThaiDate($data['date_serv']);
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
            /*
              [
              'label' => 'typearea',
              'attribute' => 'check_typearea',
              ],
             *
             */
            [
                'label' => 'ชื่อ-สกุล',
                'attribute' => 'person_name',
                'format' => 'raw',
                'value' => function($data) {
                    return '<b>' . $data['cid'] . '</b><br><small>' . $data['person_name'] . '</small>';
                }
            ],
            [
                'label' => 'Nation',
                'attribute' => 'nation',
            ],
            [
                'label' => 'PID',
                'attribute' => 'pid',
            ],
            [
                'label' => 'วันที่คลอด',
                'attribute' => 'bdate',
                'format' => 'raw',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['bdate']);
                }
            ],
            [
                'label' => 'สถานที่คลอด',
                'attribute' => 'bhosp',
            ],
            [
                'label' => 'ผู้บันทึก',
                'attribute' => 'input_bhosp',
            ],
            [
                'label' => 'สถานะการอยู่อาศัย',
                'attribute' => 'check_typearea',
                'visible' => 0,
            ],
            [
                'label' => 'ANC 1',
                'attribute' => 'g1_date',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data['g1_date'] <> '' ? Cwebclient::getThaiDate($data['g1_date']) : '');
                }
            ],
            [
                'label' => 'ANC 2',
                'attribute' => 'g2_date',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data['g2_date'] <> '' ? Cwebclient::getThaiDate($data['g2_date']) : '');
                }
            ],
            [
                'label' => 'ANC 3',
                'attribute' => 'g3_date',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data['g3_date'] <> '' ? Cwebclient::getThaiDate($data['g3_date']) : '');
                }
            ],
            [
                'label' => 'ANC 4',
                'attribute' => 'g4_date',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data['g4_date'] <> '' ? Cwebclient::getThaiDate($data['g4_date']) : '');
                }
            ],
            [
                'label' => 'ANC 5',
                'attribute' => 'g5_date',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data['g5_date'] <> '' ? Cwebclient::getThaiDate($data['g5_date']) : '');
                }
            ],
        ],
    ]);
    ?>
</div>
<?php Pjax::end(); ?>