<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\report\models\MenuGroup;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายชื่อเป้าหมายเด็กอายุ 18|30 เดือน';
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
    $data = Chospital::find()->where("hostype in ('03','05','06','07','18' ) $ampcode and provcode = '{$provcode}' {$sqlStringAdd}")->orderBy('hoscode ASC')->all();
    ?>
    <?php
    if (isset($_GET['q_hospcode']))
        echo app\modules\webclient\components\Cmapclient::widget(['point' => $point, 'zoom' => 14, 'height' => 300,
            # 'content' => '<br>ความพิการ {person_deformed_type_name}'
            'icon' => 'https://cdn3.iconfinder.com/data/icons/user-icons/32/Baby_32.png']);
    ?>
    <?=
    GridView::widget([
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
        'floatHeader' => true,
        #'export' => false,
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'เลขบัตรประชาชน',
                'attribute' => 'cid',
            ],
            [
                'label' => 'PID',
                'attribute' => 'pid',
            ],
            [
                'label' => 'ชื่อ-สกุล',
                'attribute' => 'person_name',
            ],
            [
                'label' => 'วันเดือนปีเกิด',
                'attribute' => 'birth',
                'format' => 'raw',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['birth']);
                }
            ],
            [
                'label' => 'อายุ(เดือน)',
                'attribute' => 'age',
            ],
            [
                'label' => 'สถานะการอยู่อาศัย',
                'attribute' => 'house_regist_type_id',
                'visible' => 0,
            ],
            [
                'label' => 'ช่วงบริการเริ่มต้น',
                'attribute' => 'date_start',
                'visible' => 1,
                'format' => 'raw',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['date_start']);
                }
            ],
            [
                'label' => 'ช่วงบริการสิ้นสุด',
                'attribute' => 'date_end',
                'visible' => 1,
                'format' => 'raw',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['date_end']);
                }
            ],
            [
                'label' => 'วันที่ให้บริการ',
                'attribute' => 'date_serv',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data['date_serv'] <> '' ? Cwebclient::getThaiDate($data['date_serv']) : '');
                }
            ],
            [
                'label' => 'นับผลงาน',
                'attribute' => 'pass',
                'format' => 'raw',
                'value' => function($data) {
                    $result = '';
                    if ($data['pass'] == 1) {
                        $result = Cwebclient::getThaiDate($data['date_serv']);
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
    <?php #yii\widgets\Pjax::end()       ?>
</div>
