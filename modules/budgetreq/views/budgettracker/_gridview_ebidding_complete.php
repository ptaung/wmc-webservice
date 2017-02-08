<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\icons\Icon;

Icon::map($this);
Icon::map($this, Icon::OCT);
?>

<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'layout' => "{items}",
    'hover' => true,
    'id' => 'gridviewId_complete',
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'options' => ['width' => '2%'],
        ],
        [
            'label' => 'ชื่อหน่วยงาน',
            'attribute' => 'hosp.hospcode_name',
            'options' => ['width' => '20%'],
        ],
        [
            'label' => 'ชื่อครุภัณฑ์/สิ่งก่อสร้าง',
            'attribute' => 'items.items_name',
            'options' => ['width' => '68%'],
        ],
        [
            'label' => 'ราคาต่อหน่วย',
            'attribute' => 'items.items_cost',
            'format' => ['decimal', 2],
            'options' => ['width' => '5%'],
        ],
        [
            'label' => 'วิธีจัดซื้อจัดจ้าง',
            'options' => ['width' => '5%'],
            'value' => function() {
        return 'e-bidding';
    },
        ],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand-ebidding', ['model' => $model]);
            },
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                    'expandOneOnly' => true
                ],
            ],
        ]);
        ?>


