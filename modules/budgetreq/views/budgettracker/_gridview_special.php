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
    'id' => 'gridviewId_special',
    'beforeHeader' => [
        [
            'columns' => [
                ['content' => '', 'options' => ['colspan' => 6, 'class' => 'text-center warning']],
                ['content' => 'ขั้นตอน', 'options' => ['colspan' => 13, 'class' => 'text-center warning']],
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
                return Yii::$app->controller->renderPartial('_expand-special', ['model' => $model]);
            },
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                    'expandOneOnly' => true
                ],
                [
                    'label' => '1.1',
                    'format' => 'raw',
                    'value' => function($m) {
                        if ($m->step_11 == 1) {
                            $c = 'text-success';
                        } else {
                            $c = 'text-danger';
                        }
                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                    'class' => $c,
                                    'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",1)',
                                    'data-toggle' => 'tooltip',
                                    'title' => 'แต่งตั้งคณะกรรมการกำหนดราคากลางท้องถิ่น',
                        ]);
                    },
                            'hAlign' => 'center',
                        ],
                        [
                            'label' => '1.2',
                            'format' => 'raw',
                            'value' => function($m) {
                                if ($m->step_12 == 1) {
                                    $c = 'text-success';
                                } else {
                                    $c = 'text-danger';
                                }
                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                            'class' => $c,
                                            'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",2)',
                                            'data-toggle' => 'tooltip',
                                            'title' => 'คณะกรรมการจัดทำราคากลาง',
                                ]);
                            },
                                    'hAlign' => 'center',
                                ],
                                [
                                    'label' => '1.3',
                                    'format' => 'raw',
                                    'value' => function($m) {
                                        if ($m->step_131 > 0 && !empty($m->step_132)) {
                                            $c = 'text-success';
                                        } else {
                                            $c = 'text-danger';
                                        }
                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                    'class' => $c,
                                                    'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",3)',
                                                    'data-toggle' => 'tooltip',
                                                    'title' => 'หัวหน้าส่วนราชการเห็นชอบราคากลาง',
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
                                                            'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",4)',
                                                            'data-toggle' => 'tooltip',
                                                            'title' => 'เสนอรายงานขอซื้อ/ขอจ้าง',
                                                ]);
                                            },
                                                    'hAlign' => 'center',
                                                ],
                                                [
                                                    'label' => '3.1',
                                                    'format' => 'raw',
                                                    'value' => function($m) {
                                                        if ($m->step_31 == 1) {
                                                            $c = 'text-success';
                                                        } else {
                                                            $c = 'text-danger';
                                                        }
                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                    'class' => $c,
                                                                    'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",5)',
                                                                    'data-toggle' => 'tooltip',
                                                                    'title' => 'ส่งเอกสารเชิญผู้ขาย/ผู้รับจ้าง',
                                                        ]);
                                                    },
                                                            'hAlign' => 'center',
                                                        ],
                                                        [
                                                            'label' => '3.2',
                                                            'format' => 'raw',
                                                            'value' => function($m) {
                                                                if (!empty($m->step_321) && !empty($m->step_322)) {
                                                                    $c = 'text-success';
                                                                } else {
                                                                    $c = 'text-danger';
                                                                }
                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                            'class' => $c,
                                                                            'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",6)',
                                                                            'data-toggle' => 'tooltip',
                                                                            'title' => 'ผู้ขายผู้รับจ้างจัดทำเอกสารและเสนอราคา',
                                                                ]);
                                                            },
                                                                    'hAlign' => 'center',
                                                                ],
                                                                [
                                                                    'label' => '3.3',
                                                                    'format' => 'raw',
                                                                    'value' => function($m) {
                                                                        if ($m->step_33 == 1) {
                                                                            $c = 'text-success';
                                                                        } else {
                                                                            $c = 'text-danger';
                                                                        }
                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                    'class' => $c,
                                                                                    'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",7)',
                                                                                    'data-toggle' => 'tooltip',
                                                                                    'title' => 'คณะกรรมการจัดซื้อพิจารณาเอกสาร/คัดเลือก/ต่อรอง',
                                                                        ]);
                                                                    },
                                                                            'hAlign' => 'center',
                                                                        ],
                                                                        [
                                                                            'label' => '4.1',
                                                                            'format' => 'raw',
                                                                            'value' => function($m) {
                                                                                if ($m->step_411 > 0 && !empty($m->step_412)) {
                                                                                    $c = 'text-success';
                                                                                } else {
                                                                                    $c = 'text-danger';
                                                                                }
                                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                            'class' => $c,
                                                                                            'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",8)',
                                                                                            'data-toggle' => 'tooltip',
                                                                                            'title' => 'คณะกรรมการรายงานผลการจัดซื้อจัดจ้าง',
                                                                                ]);
                                                                            },
                                                                                    'hAlign' => 'center',
                                                                                ],
                                                                                [
                                                                                    'label' => '4.2',
                                                                                    'format' => 'raw',
                                                                                    'value' => function($m) {
                                                                                        if (!empty($m->step_42)) {
                                                                                            $c = 'text-success';
                                                                                        } else {
                                                                                            $c = 'text-danger';
                                                                                        }
                                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                    'class' => $c,
                                                                                                    'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",9)',
                                                                                                    'data-toggle' => 'tooltip',
                                                                                                    'title' => 'ขออนุมัติแบบรูปวงเงิน',
                                                                                        ]);
                                                                                    },
                                                                                            'hAlign' => 'center',
                                                                                        ],
                                                                                        [
                                                                                            'label' => '4.3',
                                                                                            'format' => 'raw',
                                                                                            'value' => function($m) {
                                                                                                if ($m->step_43 == 1) {
                                                                                                    $c = 'text-success';
                                                                                                } else {
                                                                                                    $c = 'text-danger';
                                                                                                }
                                                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                            'class' => $c,
                                                                                                            'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",10)',
                                                                                                            'data-toggle' => 'tooltip',
                                                                                                            'title' => 'ตรวจสอบเอกสารจัดซื้อจัดจ้าง',
                                                                                                ]);
                                                                                            },
                                                                                                    'hAlign' => 'center',
                                                                                                ],
                                                                                                [
                                                                                                    'label' => '5',
                                                                                                    'format' => 'raw',
                                                                                                    'value' => function($m) {
                                                                                                        if ($m->step_5 == 1) {
                                                                                                            $c = 'text-success';
                                                                                                        } else {
                                                                                                            $c = 'text-danger';
                                                                                                        }
                                                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                                    'class' => $c,
                                                                                                                    'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",11)',
                                                                                                                    'data-toggle' => 'tooltip',
                                                                                                                    'title' => 'ขออนุมัติซื้อ/สั่งจ้าง',
                                                                                                        ]);
                                                                                                    },
                                                                                                            'hAlign' => 'center',
                                                                                                        ],
                                                                                                        [
                                                                                                            'label' => '6.1',
                                                                                                            'format' => 'raw',
                                                                                                            'value' => function($m) {
                                                                                                                if ($m->step_61 == 1) {
                                                                                                                    $c = 'text-success';
                                                                                                                } else {
                                                                                                                    $c = 'text-danger';
                                                                                                                }
                                                                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                                            'class' => $c,
                                                                                                                            'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",12)',
                                                                                                                            'data-toggle' => 'tooltip',
                                                                                                                            'title' => 'แจ้งผู้ขาย/ผู้รับจ้างมาลงนามใน 7 วันหลังรับเอกสาร',
                                                                                                                ]);
                                                                                                            },
                                                                                                                    'hAlign' => 'center',
                                                                                                                ],
                                                                                                                [
                                                                                                                    'label' => '6.2',
                                                                                                                    'format' => 'raw',
                                                                                                                    'value' => function($m) {
                                                                                                                        if (!empty($m->step_621) && !empty($m->step_622) && $m->step_623 > 0) {
                                                                                                                            $c = 'text-success';
                                                                                                                        } else {
                                                                                                                            $c = 'text-danger';
                                                                                                                        }
                                                                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                                                    'class' => $c,
                                                                                                                                    'onclick' => 'updateProcess(this,"' . Url::to(['updatespecial', 'id' => $m->step_special_id]) . '",13)',
                                                                                                                                    'data-toggle' => 'tooltip',
                                                                                                                                    'title' => 'เสนอผู้มีอำนาจลงนามในสัญญา',
                                                                                                                        ]);
                                                                                                                    },
                                                                                                                            'hAlign' => 'center',
                                                                                                                        ],
                                                                                                                        'step_slow',
                                                                                                                    // 'step_comment:ntext',
#['class' => 'yii\grid\ActionColumn'],
                                                                                                                    ],
                                                                                                                ]);
                                                                                                                ?>


