<?php

use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\helpers\Html;

#use kartik\editable\Editable;

Icon::map($this);
Icon::map($this, Icon::OCT);
?>

<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'layout' => "{items}",
    'hover' => true,
    'id' => 'gridviewId_shopping',
    'beforeHeader' => [
        [
            'columns' => [
                ['content' => '', 'options' => ['colspan' => 6, 'class' => 'text-center warning']],
                ['content' => 'ขั้นตอน', 'options' => ['colspan' => 5, 'class' => 'text-center warning']],
                ['content' => '', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
            ],
        ],
    ],
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'options' => ['width' => '2%'],
        ],
        [
            'label' => 'ชื่อหน่วยงาน',
            'attribute' => 'hosp.hospcode_name',
            'options' => ['width' => '10%'],
        ],
        [
            'label' => 'ชื่อครุภัณฑ์/สิ่งก่อสร้าง',
            'attribute' => 'items.items_name',
            'options' => ['width' => '20%'],
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
        return 'วิธีพิเศษ';
    },
        ],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand-shopping', ['model' => $model]);
            },
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                    'expandOneOnly' => true
                ],
                [
                    'label' => '1',
                    'format' => 'raw',
                    'value' => function($m) {
                        if (!empty($m->step_1)) {
                            $c = 'text-success';
                        } else {
                            $c = 'text-danger';
                        }
                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                    'class' => $c,
                                    'onclick' => 'updateProcess(this,"' . Url::to(['updateshopping', 'id' => $m->step_shopping_id]) . '",1)',
                                    'data-toggle' => 'tooltip',
                                    'title' => 'จัดทำเอกสารประกาศสอบราคา',
                        ]);
                    },
                            'hAlign' => 'center',
                        ],
                        [
                            'label' => '2',
                            'format' => 'raw',
                            'value' => function($m) {
                                if (!empty($m->step_21) && !empty($m->step_22)) {
                                    $c = 'text-success';
                                } else {
                                    $c = 'text-danger';
                                }
                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                            'class' => $c,
                                            'onclick' => 'updateProcess(this,"' . Url::to(['updateshopping', 'id' => $m->step_shopping_id]) . '",2)',
                                            'data-toggle' => 'tooltip',
                                            'title' => 'เสนอหัวหน้าส่วนราชการเห็นชอบ',
                                ]);
                            },
                                    'hAlign' => 'center',
                                ],
                                [
                                    'label' => '3',
                                    'format' => 'raw',
                                    'value' => function($m) {
                                        if ($m->step_3 == 1) {
                                            $c = 'text-success';
                                        } else {
                                            $c = 'text-danger';
                                        }
                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                    'class' => $c,
                                                    'onclick' => 'updateProcess(this,"' . Url::to(['updateshopping', 'id' => $m->step_shopping_id]) . '",3)',
                                                    'data-toggle' => 'tooltip',
                                                    'title' => 'เจ้าหน้าที่รับซอง',
                                        ]);
                                    },
                                            'hAlign' => 'center',
                                        ],
                                        [
                                            'label' => '4',
                                            'format' => 'raw',
                                            'value' => function($m) {
                                                if (!empty($m->step_41) && !empty($m->step_42) && $m->step_43 > 1) {
                                                    $c = 'text-success';
                                                } else {
                                                    $c = 'text-danger';
                                                }
                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                            'class' => $c,
                                                            'onclick' => 'updateProcess(this,"' . Url::to(['updateshopping', 'id' => $m->step_shopping_id]) . '",4)',
                                                            'data-toggle' => 'tooltip',
                                                            'title' => 'คณะกรรมการเปิดซองสอบราคา',
                                                ]);
                                            },
                                                    'hAlign' => 'center',
                                                ],
                                                [
                                                    'label' => '5',
                                                    'format' => 'raw',
                                                    'value' => function($m) {
                                                        if (!empty($m->step_51) && !empty($m->step_52)) {
                                                            $c = 'text-success';
                                                        } else {
                                                            $c = 'text-danger';
                                                        }
                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                    'class' => $c,
                                                                    'onclick' => 'updateProcess(this,"' . Url::to(['updateshopping', 'id' => $m->step_shopping_id]) . '",5)',
                                                                    'data-toggle' => 'tooltip',
                                                                    'title' => 'เสนอหัวหน้าส่วนราชการลงนาม',
                                                        ]);
                                                    },
                                                            'hAlign' => 'center',
                                                        ],
                                                        'step_slow',
                                                    // 'step_comment:ntext',
                                                    ],
                                                ]);
                                                ?>


