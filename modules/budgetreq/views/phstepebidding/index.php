<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\icons\Icon;

Icon::map($this);
Icon::map($this, Icon::OCT);

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Step Ebiddings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-step-ebidding-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Step Ebidding', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>


    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">รายการที่กำลังดำเนินการ</a></li>
            <li role="presentation"><a href="#complete" aria-controls="complete" role="tab" data-toggle="tab">รายการที่ดำเนินการเสร็จสิ้น</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <h3 class="panel-title">e-bidding</h3>
                <div>
                    <p>
                        ขั้นตอนที่ต้องดำเนินการให้ทันของครุภัณฑ์/สิ่งก่อสร้างปีเดียว : 5.2 จัดทำสัญญา<br>
                        ขั้นตอนที่ต้องดำเนินการให้ทันของสิ่งก่อสร้างผูกพัน : 5.2 จัดทำสัญญา
                    </p>
                </div>
                <?=
                GridView::widget([
                    'dataProvider' => $dataEbidding,
                    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
                    'layout' => "{items}",
                    'beforeHeader' => [
                        [
                            'columns' => [
                                ['content' => '', 'options' => ['colspan' => 5, 'class' => 'text-center warning']],
                                ['content' => 'ขั้นตอน', 'options' => ['colspan' => 16, 'class' => 'text-center warning']],
                                ['content' => '', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                            ],
                        ],
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                        ],
                        [
                            'label' => 'ชื่อหน่วยงาน',
                            'attribute' => 'hosp.hospcode_name',
                        ],
                        [
                            'label' => 'ชื่อครุภัณฑ์/สิ่งก่อสร้าง',
                            'attribute' => 'items.items_name',
                        ],
                        [
                            'label' => 'ราคาต่อหน่วย',
                            'attribute' => 'items.items_cost',
                            'format' => ['decimal', 2],
                        ],
                        [
                            'label' => 'วิธีจัดซื้อจัดจ้าง',
                            'value' => function() {
                                return 'e-bidding';
                            },
                        ],
                        [
                            'label' => '1.1',
                            'format' => 'raw',
                            'value' => function($m) {
                                return Html::a(Icon::show('code', ['class' => 'glyphicon-expand'], Icon::BSG), '#', ['class' => 'text-success']);
                            },
                                    'hAlign' => 'center',
                                ],
                                [
                                    'label' => '1.2',
                                    'format' => 'raw',
                                    'value' => function($m) {
                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                    },
                                            'hAlign' => 'center',
                                        ],
                                        [
                                            'label' => '1.3',
                                            'format' => 'raw',
                                            'value' => function($m) {
                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                            },
                                                    'hAlign' => 'center',
                                                ],
                                                [
                                                    'label' => '1.4',
                                                    'format' => 'raw',
                                                    'value' => function($m) {
                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                    },
                                                            'hAlign' => 'center',
                                                        ],
                                                        [
                                                            'label' => '1.5',
                                                            'format' => 'raw',
                                                            'value' => function($m) {
                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                            },
                                                                    'hAlign' => 'center',
                                                                ],
                                                                [
                                                                    'label' => '2.1',
                                                                    'format' => 'raw',
                                                                    'value' => function($m) {
                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                                    },
                                                                            'hAlign' => 'center',
                                                                        ],
                                                                        [
                                                                            'label' => '2.2',
                                                                            'format' => 'raw',
                                                                            'value' => function($m) {
                                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                                            },
                                                                                    'hAlign' => 'center',
                                                                                ],
                                                                                [
                                                                                    'label' => '3.1',
                                                                                    'format' => 'raw',
                                                                                    'value' => function($m) {
                                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                                                    },
                                                                                            'hAlign' => 'center',
                                                                                        ],
                                                                                        [
                                                                                            'label' => '3.2',
                                                                                            'format' => 'raw',
                                                                                            'value' => function($m) {
                                                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                                                            },
                                                                                                    'hAlign' => 'center',
                                                                                                ],
                                                                                                [
                                                                                                    'label' => '3.3',
                                                                                                    'format' => 'raw',
                                                                                                    'value' => function($m) {
                                                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                                                                    },
                                                                                                            'hAlign' => 'center',
                                                                                                        ],
                                                                                                        [
                                                                                                            'label' => '3.4',
                                                                                                            'format' => 'raw',
                                                                                                            'value' => function($m) {
                                                                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                                                                            },
                                                                                                                    'hAlign' => 'center',
                                                                                                                ],
                                                                                                                [
                                                                                                                    'label' => '3.5',
                                                                                                                    'format' => 'raw',
                                                                                                                    'value' => function($m) {
                                                                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                                                                                    },
                                                                                                                            'hAlign' => 'center',
                                                                                                                        ],
                                                                                                                        [
                                                                                                                            'label' => '4.1',
                                                                                                                            'format' => 'raw',
                                                                                                                            'value' => function($m) {
                                                                                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                                                                                            },
                                                                                                                                    'hAlign' => 'center',
                                                                                                                                ],
                                                                                                                                [
                                                                                                                                    'label' => '4.2',
                                                                                                                                    'format' => 'raw',
                                                                                                                                    'value' => function($m) {
                                                                                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                                                                                                    },
                                                                                                                                            'hAlign' => 'center',
                                                                                                                                        ],
                                                                                                                                        [
                                                                                                                                            'label' => '5.1',
                                                                                                                                            'format' => 'raw',
                                                                                                                                            'value' => function($m) {
                                                                                                                                                return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                                                                                                            },
                                                                                                                                                    'hAlign' => 'center',
                                                                                                                                                ],
                                                                                                                                                [
                                                                                                                                                    'label' => '5.2',
                                                                                                                                                    'format' => 'raw',
                                                                                                                                                    'value' => function($m) {
                                                                                                                                                        return Html::a(Icon::show('code', ['class' => 'glyphicon-unchecked'], Icon::BSG), '#', ['class' => '']);
                                                                                                                                                    },
                                                                                                                                                            'hAlign' => 'center',
                                                                                                                                                        ],
                                                                                                                                                        'step_slow',
                                                                                                                                                    // 'step_comment:ntext',
                                                                                                                                                    #['class' => 'yii\grid\ActionColumn'],
                                                                                                                                                    ],
                                                                                                                                                ]);
                                                                                                                                                ?>

                                                                                                                                            </div>
                                                                                                                                            <div role="tabpanel" class="tab-pane" id="complete">...</div>
                                                                                                                                        </div>

                                                                                                                                    </div>




                                                                                                                                    <?php Pjax::end(); ?>
</div>
