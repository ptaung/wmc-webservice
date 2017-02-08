<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\report\models\MenuGroup;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลประชากร';
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
    if (isset($_GET['q_search']))
        echo app\modules\webclient\components\Cmapclient::widget(['point' => $point, 'zoom' => 9, 'height' => 300, 'content' => '{address} ', 'icon' => '']);
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
  </div>
  <button type="submit" class="btn btn-success btn-sm">ค้นหา</button>
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
                'label' => 'ชื่อ-สกุล',
                'attribute' => 'person_name',
            ],
            [
                'label' => 'ที่อยู่',
                'attribute' => 'address',
            ],
            [
                'label' => 'อายุ',
                'attribute' => 'age',
            ],
            [
                'label' => 'สถานะการอยู่อาศัย',
                'attribute' => 'TYPEAREA',
            #'visible' => 0,
            ],
            [
                'label' => 'วันเดือนปีเกิด',
                'attribute' => 'BIRTH',
                'format' => 'raw',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['BIRTH']);
                }
            ],
            [
                'label' => 'สถานบริการที่บันทึกข้อมูล',
                'attribute' => 'hospcode',
                'format' => 'raw',
                'value' => function($data) {
                    return Cwebclient::getHoscode($data['hospcode']);
                }
            ],
            [
                'label' => 'lat',
                'attribute' => 'lat',
                'format' => 'raw',
            ],
            [
                'label' => 'lng',
                'attribute' => 'lng',
                'format' => 'raw',
            ],
            [
                'label' => 'แก้ไขล่าสุด',
                'attribute' => 'd_update',
                'format' => 'raw',
                'value' => function($data) {
                    return Cwebclient::getThaiDate($data['d_update'], 'S', 1);
                }
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
