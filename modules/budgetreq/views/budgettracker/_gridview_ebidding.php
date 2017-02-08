<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\icons\Icon;

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
    'id' => 'gridviewId',
    'beforeHeader' => [
        [
            'columns' => [
                ['content' => '', 'options' => ['colspan' => 6, 'class' => 'text-center warning']],
                ['content' => 'ขั้นตอน', 'options' => ['colspan' => 16, 'class' => 'text-center warning']],
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
                                    'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",1)',
                                    'data-toggle' => 'tooltip',
                                    'title' => 'แต่งตั้งคณะกรรมการกำหนดราคากลาง/คณะกรรมการพิจารณาจัดทำเอกสาร',
                                        #'onclick' => 'confirm("คุณต้องการยื่นยันการดำเนินการขั้นตอนนี้หรือไม่")',
                        ]);
                    },
                            'hAlign' => 'center',
                        ],
                        [
                            'label' => '1.2',
                            'format' => 'raw',
                            'value' => function($m) {
                                if ($m->step_121 > 0 && !empty($m->step_122)) {
                                    $c = 'text-success';
                                } else {
                                    $c = 'text-danger';
                                }
                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                            'class' => $c,
                                            'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",2)',
                                            'data-toggle' => 'tooltip',
                                            'title' => 'จัดทำราคากลาง/หัวหน้าส่วนราชการเห็นชอบ',
                                ]);
                            },
                                    'hAlign' => 'center',
                                ],
                                [
                                    'label' => '1.3',
                                    'format' => 'raw',
                                    'value' => function($m) {
                                        if ($m->step_13 == 1) {
                                            $c = 'text-success';
                                        } else {
                                            $c = 'text-danger';
                                        }
                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                    'class' => $c,
                                                    'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",3)',
                                                    'data-toggle' => 'tooltip',
                                                    'title' => 'ทำเอกสารประกวดราคาเผยแพร่วิจารณ์',
                                        ]);
                                    },
                                            'hAlign' => 'center',
                                        ],
                                        [
                                            'label' => '1.4',
                                            'format' => 'raw',
                                            'value' => function($m) {
                                                if ($m->step_14 == 1) {
                                                    $c = 'text-success';
                                                } else {
                                                    $c = 'text-danger';
                                                }
                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                            'class' => $c,
                                                            'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",4)',
                                                            'data-toggle' => 'tooltip',
                                                            'title' => 'จัดทำรายงานขอซื้อขอจ้าง/แต่งตั้งคณะกรรมการพิจารณาผลการประกวดราคา',
                                                ]);
                                            },
                                                    'hAlign' => 'center',
                                                ],
                                                [
                                                    'label' => '1.5',
                                                    'format' => 'raw',
                                                    'value' => function($m) {
                                                        if ($m->step_15 == 1) {
                                                            $c = 'text-success';
                                                        } else {
                                                            $c = 'text-danger';
                                                        }
                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                    'class' => $c,
                                                                    'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",5)',
                                                                    'data-toggle' => 'tooltip',
                                                                    'title' => 'เสนอหัวหน้าส่วนราชการเห็นชอบเอกสารและลงนามประกาศเชิญชวน',
                                                        ]);
                                                    },
                                                            'hAlign' => 'center',
                                                        ],
                                                        [
                                                            'label' => '2.1',
                                                            'format' => 'raw',
                                                            'value' => function($m) {
                                                                if (!empty($m->step_211) && !empty($m->step_212)) {
                                                                    $c = 'text-success';
                                                                } else {
                                                                    $c = 'text-danger';
                                                                }
                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                            'class' => $c,
                                                                            'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",6)',
                                                                            'data-toggle' => 'tooltip',
                                                                            'title' => 'ทำเอกสารที่ได้รับความเห็นชอบเผยแพร่ในเว็บไซต์หน่วยงาน/กรมบัญชีกลางไม่น้อยกว่า3วันทำการ',
                                                                ]);
                                                            },
                                                                    'hAlign' => 'center',
                                                                ],
                                                                [
                                                                    'label' => '2.2',
                                                                    'format' => 'raw',
                                                                    'value' => function($m) {
                                                                        if ($m->step_22 == 1) {
                                                                            $c = 'text-success';
                                                                        } else {
                                                                            $c = 'text-danger';
                                                                        }
                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                    'class' => $c,
                                                                                    'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",7)',
                                                                                    'data-toggle' => 'tooltip',
                                                                                    'title' => 'ให้ผู้เสนอราคาจัดทำเอกสารไม่น้อยกว่า3วันทำการ',
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
                                                                                            'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",8)',
                                                                                            'data-toggle' => 'tooltip',
                                                                                            'title' => 'ผู้เสนอราคาเสนอราคาผ่านระบบอิเล็กทรอนิกส์',
                                                                                ]);
                                                                            },
                                                                                    'hAlign' => 'center',
                                                                                ],
                                                                                [
                                                                                    'label' => '3.2',
                                                                                    'format' => 'raw',
                                                                                    'value' => function($m) {
                                                                                        if ($m->step_32 > 0) {
                                                                                            $c = 'text-success';
                                                                                        } else {
                                                                                            $c = 'text-danger';
                                                                                        }
                                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                    'class' => $c,
                                                                                                    'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",9)',
                                                                                                    'data-toggle' => 'tooltip',
                                                                                                    'title' => 'คณะกรรมการพิจารณาข้อเสนอ',
                                                                                        ]);
                                                                                    },
                                                                                            'hAlign' => 'center',
                                                                                        ],
                                                                                        [
                                                                                            'label' => '3.3',
                                                                                            'format' => 'raw',
                                                                                            'value' => function($m) {
                                                                                                if ($m->step_331 > 0 && !empty($m->step_332)) {
                                                                                                    $c = 'text-success';
                                                                                                } else {
                                                                                                    $c = 'text-danger';
                                                                                                }
                                                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                            'class' => $c,
                                                                                                            'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",10)',
                                                                                                            'data-toggle' => 'tooltip',
                                                                                                            'title' => 'คณะกรรมการรายงานผลการพิจารณาพร้อมด้วยเอกสารที่รับไว้ทั้งหมดต่อหัวหน้าส่วนราชการ',
                                                                                                ]);
                                                                                            },
                                                                                                    'hAlign' => 'center',
                                                                                                ],
                                                                                                [
                                                                                                    'label' => '3.4',
                                                                                                    'format' => 'raw',
                                                                                                    'value' => function($m) {
                                                                                                        if ($m->step_34 == 1) {
                                                                                                            $c = 'text-success';
                                                                                                        } else {
                                                                                                            $c = 'text-danger';
                                                                                                        }
                                                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                                    'class' => $c,
                                                                                                                    'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",11)',
                                                                                                                    'data-toggle' => 'tooltip',
                                                                                                                    'title' => 'ขออนุมัติรูปแบบวงเงินและระยะเวลาก่อหนี้ผูกพันจากสำนักงบประมาณ/ครม.(แล้วแต่กรณี/ถ้ามี)',
                                                                                                        ]);
                                                                                                    },
                                                                                                            'hAlign' => 'center',
                                                                                                        ],
                                                                                                        [
                                                                                                            'label' => '3.5',
                                                                                                            'format' => 'raw',
                                                                                                            'value' => function($m) {
                                                                                                                if ($m->step_35 == 1) {
                                                                                                                    $c = 'text-success';
                                                                                                                } else {
                                                                                                                    $c = 'text-danger';
                                                                                                                }
                                                                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                                            'class' => $c,
                                                                                                                            'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",12)',
                                                                                                                            'data-toggle' => 'tooltip',
                                                                                                                            'title' => 'ตรวจสอบเอกสารจัดซื้อจัดจ้างกับกลุ่มคลัง/กลุ่มกฎหมาย',
                                                                                                                ]);
                                                                                                            },
                                                                                                                    'hAlign' => 'center',
                                                                                                                ],
                                                                                                                [
                                                                                                                    'label' => '4.1',
                                                                                                                    'format' => 'raw',
                                                                                                                    'value' => function($m) {
                                                                                                                        if ($m->step_41 == 1) {
                                                                                                                            $c = 'text-success';
                                                                                                                        } else {
                                                                                                                            $c = 'text-danger';
                                                                                                                        }
                                                                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                                                    'class' => $c,
                                                                                                                                    'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",13)',
                                                                                                                                    'data-toggle' => 'tooltip',
                                                                                                                                    'title' => 'เสนอหัวหน้าส่วนราชการผู้มีอำนาจสั่งซื้อสั่งจ้าง',
                                                                                                                        ]);
                                                                                                                    },
                                                                                                                            'hAlign' => 'center',
                                                                                                                        ],
                                                                                                                        [
                                                                                                                            'label' => '4.2',
                                                                                                                            'format' => 'raw',
                                                                                                                            'value' => function($m) {
                                                                                                                                if ($m->step_42 == 1) {
                                                                                                                                    $c = 'text-success';
                                                                                                                                } else {
                                                                                                                                    $c = 'text-danger';
                                                                                                                                }
                                                                                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                                                            'class' => $c,
                                                                                                                                            'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",14)',
                                                                                                                                            'data-toggle' => 'tooltip',
                                                                                                                                            'title' => 'แจ้งผลการเสนอราคาให้ผู้เสนอราคาทราบ',
                                                                                                                                ]);
                                                                                                                            },
                                                                                                                                    'hAlign' => 'center',
                                                                                                                                ],
                                                                                                                                [
                                                                                                                                    'label' => '5.1',
                                                                                                                                    'format' => 'raw',
                                                                                                                                    'value' => function($m) {
                                                                                                                                        if ($m->step_51 == 1) {
                                                                                                                                            $c = 'text-success';
                                                                                                                                        } else {
                                                                                                                                            $c = 'text-danger';
                                                                                                                                        }
                                                                                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                                                                    'class' => $c,
                                                                                                                                                    'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",15)',
                                                                                                                                                    'data-toggle' => 'tooltip',
                                                                                                                                                    'title' => 'ร่างเอกสารสัญญาแจ้งผู้เสนอราคาได้ทำเอกสารการทำสัญญา',
                                                                                                                                        ]);
                                                                                                                                    },
                                                                                                                                            'hAlign' => 'center',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'label' => '5.2',
                                                                                                                                            'format' => 'raw',
                                                                                                                                            'value' => function($m) {
                                                                                                                                                if (!empty($m->step_521) && !empty($m->step_522) && $m->step_523 > 0) {
                                                                                                                                                    $c = 'text-success';
                                                                                                                                                } else {
                                                                                                                                                    $c = 'text-danger';
                                                                                                                                                }
                                                                                                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', [
                                                                                                                                                            'class' => $c,
                                                                                                                                                            'onclick' => 'updateProcess(this,"' . yii\helpers\Url::to(['updateebidding', 'id' => $m->step_ebidding_id]) . '",16)',
                                                                                                                                                            'data-toggle' => 'tooltip',
                                                                                                                                                            'title' => 'จัดทำสัญญา',
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


