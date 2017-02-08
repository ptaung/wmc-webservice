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
    'id' => 'gridviewId_deal',
    'beforeHeader' => [
        [
            'columns' => [
                ['content' => '', 'options' => ['colspan' => 6, 'class' => 'text-center warning']],
                ['content' => 'ขั้นตอน', 'options' => ['colspan' => 4, 'class' => 'text-center warning']],
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
                return Yii::$app->controller->renderPartial('_expand-deal', ['model' => $model]);
            },
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                    'expandOneOnly' => true
                ],
                [
                    'label' => '1',
                    'format' => 'raw',
                    'value' => function($m) {
                        if ($m->step_1 == 1) {
                            $c = 'text-success';
                        } else {
                            $c = 'text-danger';
                        }
                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                    'class' => $c,
                                    'onclick' => 'updateProcess(this,"' . Url::to(['updatedeal', 'id' => $m->step_deal_id]) . '",1)',
                                    'data-toggle' => 'tooltip',
                                    'title' => 'ติดต่อตกลงราคากับผู้ขาย/ผู้รับจ้าง',
                        ]);
                    },
                            'hAlign' => 'center',
                        ],
                        [
                            'label' => '2',
                            'format' => 'raw',
                            'value' => function($m) {
                                if ($m->step_2 == 1) {
                                    $c = 'text-success';
                                } else {
                                    $c = 'text-danger';
                                }
                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                            'class' => $c,
                                            'onclick' => 'updateProcess(this,"' . Url::to(['updatedeal', 'id' => $m->step_deal_id]) . '",2)',
                                            'data-toggle' => 'tooltip',
                                            'title' => 'การจัดทำรายงานต่อหัวหน้าส่วนราชการเพื่อให้ความเห็นชอบ',
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
                                                    'onclick' => 'updateProcess(this,"' . Url::to(['updatedeal', 'id' => $m->step_deal_id]) . '",3)',
                                                    'data-toggle' => 'tooltip',
                                                    'title' => 'การเสนอสั่งซื้อ/สั่งจ้าง',
                                        ]);
                                    },
                                            'hAlign' => 'center',
                                        ],
                                        [
                                            'label' => '4',
                                            'format' => 'raw',
                                            'value' => function($m) {
                                                if ($m->step_41 > 0 && !empty($m->step_42) && !empty($m->step_43) && !empty($m->step_44)) {
                                                    $c = 'text-success';
                                                } else {
                                                    $c = 'text-danger';
                                                }
                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                            'class' => $c,
                                                            'onclick' => 'updateProcess(this,"' . Url::to(['updatedeal', 'id' => $m->step_deal_id]) . '",4)',
                                                            'data-toggle' => 'tooltip',
                                                            'title' => 'การสั่งซื้อสั่งจ้าง',
                                                ]);
                                            },
                                                    'hAlign' => 'center',
                                                ],
                                                'step_slow',
                                            // 'step_comment:ntext',
                                            ],
                                        ]);
                                        ?>


