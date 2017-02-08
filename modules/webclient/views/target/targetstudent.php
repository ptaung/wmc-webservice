<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายชื่อเด็กนักเรียนในพื้นที่รับผิดชอบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-group-index">
    <?php
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
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => '', 'options' => ['colspan' => 6, 'class' => 'text-center warning']],
                    ['content' => 'เทอม 2 ตค.-ธค.', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                    ['content' => 'เทอม 1 พค.-กค.', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                #['content' => 'ตรวจโปรตีน macroalbumin', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                #['content' => 'ตรวจหาค่า eGFR', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                ],
            ],
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> ' . $this->title . '</h3>',
            'type' => 'default',
            'before' => '<div class="btn-group" role="group" aria-label="">'
            . '<form class="navbar-form navbar-left" method="GET" role="search" data-pjax="true">
  <div class="form-group">

    ' . Html::textInput('q_search', $_GET['q_search'], ['class' => 'form-control input-sm', 'placeholder' => 'ค้นหารายชื่อ-เลข 13 หลัก']) . '
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
        'export' => [
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
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ชื่อโรงเรียน',
                'attribute' => 'school_name',
                'groupedRow' => true,
                'group' => true,
                'groupOddCssClass' => 'kv-grouped-row', // configure odd group cell css class
                'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
            ],
            [
                'label' => 'ชั้น',
                'attribute' => 'school_class',
                'group' => true,
            ],
            [
                'label' => 'เลขบัตรประชาชน',
                'attribute' => 'cid',
                'visible' => 1,
            ],
            [
                'label' => 'ชื่อ-สกุล',
                'attribute' => 'person_name',
            ],
            [
                'label' => 'อายุ',
                'attribute' => 'age_y',
            ],
            [
                'label' => 'วันที่ตรวจ',
                'attribute' => 'DATE_SERV1',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['DATE_SERV1']);
                }
            ],
            [
                'label' => 'น้ำหนัก',
                'attribute' => 'WEIGHT1',
                'hAlign' => 'right',
            ],
            [
                'label' => 'ส่วนสูง',
                'attribute' => 'HEIGHT1',
                'hAlign' => 'right',
            ],
            [
                'label' => 'วันที่ตรวจ',
                'attribute' => 'DATE_SERV2',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['DATE_SERV2']);
                }
            ],
            [
                'label' => 'น้ำหนัก',
                'attribute' => 'WEIGHT2',
                'hAlign' => 'right',
            ],
            [
                'label' => 'ส่วนสูง',
                'attribute' => 'HEIGHT2',
                'hAlign' => 'right',
            ],
        ],
    ]);
    ?>
    <?php #yii\widgets\Pjax::end()       ?>
</div>
