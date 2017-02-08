<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\report\models\WdepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wdeps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wdep-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Wdep', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
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
                                        'template' => '{edit}{remove}'
                                    ],
                                #['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]);
                            ?>

</div>
