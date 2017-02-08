<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\report\models\WdepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wdeps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wdep-index">

    <?=
    GridView::widget([
        'export' => false,
        'floatHeader' => true,
        'panel' => [
            //'before' => '',
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> หน่วยงาน</h3>',
            'type' => 'default',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มรายการ', ['create'], ['class' => 'btn btn-success']),
        #'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        #'footer' => false
        ],
        'dataProvider' => $dataProvider,
        #'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'hoscode',
            [
                'label' => 'ชื่อหน่วยงาน',
                'attribute' => 'hosname',
                'format' => 'raw',
            ],
            'distcode',
            'active',
            [
                'label' => 'จำนวนรายงาน',
                'format' => 'raw',
                'value' => function($m) {
                    return Html::a($m['cc'], ['/report/wuseitems', 'hoscode' => $m['hoscode']], ['class' => 'btn btn-success btn-xs']);
                },
                    ],
                    [
                        'label' => '#',
                        'format' => 'raw',
                        'value' => function($m) {
                            return Html::a('เพิ่มรายการ', ['/report/wuseitems/create', 'hoscode' => $m['hoscode']], ['class' => 'btn btn-danger btn-xs']);
                        },
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'buttons' => [
                                    'edit' => function ($url, $model) {
                                        $url = yii\helpers\Url::toRoute(['update', 'id' => $model['hoscode']]);
                                        return Html::a('แก้ไข', $url, [
                                                    'title' => \Yii::t('yii', 'Update'),
                                                    'class' => 'btn btn-default btn-xs',
                                                    'data-pjax' => '0',
                                        ]);
                                    },
                                            'remove' => function ($url, $model) {
                                        $url = yii\helpers\Url::toRoute(['delete', 'id' => $model['hoscode']]);
                                        return Html::a('ลบรายการ', $url, [
                                                    'class' => 'btn btn-default btn-xs',
                                                    'title' => \Yii::t('yii', 'Delete'),
                                                    'data-confirm' => \Yii::t('yii', 'Are you sure to delete this item?'),
                                                    'data-method' => 'post',
                                                    'data-pjax' => '0',
                                        ]);
                                    }
                                        ],
                                        'template' => '<div class="btn-group">{edit}{remove}</div>'
                                    ],
                                #['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]);
                            ?>

</div>
