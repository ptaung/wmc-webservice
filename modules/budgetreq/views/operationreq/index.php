<?php

use yii\helpers\Html;
#use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บันทึกคำของบประมาณ';
$this->params['breadcrumbs'][] = 'คำของบประมาณ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-operation-request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="pull-left">
        <?= Html::a('บันทึกคำของบประมาณ', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="pull-right">
        <?= Html::a('ตั้งคำขอ ครุภัณฑ์', ['create'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('ตั้งคำขอ สิ่งก่อสร้าง', ['create'], ['class' => 'btn btn-warning']) ?>
    </div>
    <div class="clearfix"></div>
</p>




<?=
GridView::widget([
    'panel' => [
        //'before' => '',
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-envelope"></i> บันทึกคำของบประมาณ</h3>',
        'type' => 'primary',
    #'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
    #'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
    #'footer' => false
    ],
    'dataProvider' => $dataProvider,
    'pjax' => true,
    'floatHeader' => true,
    'toggleDataContainer' => ['class' => 'btn-group-xs'],
    'exportContainer' => ['class' => 'btn-group-xs'],
    'tableOptions' => ['class' => 'table table-striped table-hover tabs-stacked'],
    'beforeHeader' => [
        [
            'columns' => [
                ['content' => ''],
                ['content' => ''],
                ['content' => ''],
                ['content' => ''],
                ['content' => ''],
                ['content' => 'สถานะคำขอ งปม.', 'options' => ['colspan' => 2, 'class' => 'text-center']],
                ['content' => '',],
            ],
        ]
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'งบประมาณ',
            'attribute' => 'request.fullname',
            'mergeHeader' => true,
            'group' => true, // enable grouping
        ],
        [
            'attribute' => 'operation.operation_name',
        #'mergeHeader' => true,
        ],
        [
            'attribute' => 'request_center_detail',
        #'mergeHeader' => true,
        ],
        [
            'attribute' => 'request_local_detail',
        #'mergeHeader' => true,
        ],
        [
            'label' => 'ครุภัณฑ์',
            'format' => 'raw',
            'hAlign' => 'center',
            'value' => function($data) {
                return '<div class="btn btn-success"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> แสดงรายการ</div>';
            },
        ],
        [
            'label' => 'สิ่งก่อสร้าง',
            'format' => 'raw',
            'hAlign' => 'center',
            'value' => function($data) {
                return '<div class="btn btn-success"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> แสดงรายการ</div>';
            },
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>

</div>
