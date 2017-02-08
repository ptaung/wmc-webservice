<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\report\models\WuseItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wuse Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wuse-items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Wuse Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\CheckboxColumn'],
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'label' => 'รหัสหน่วยบริการ',
                'format' => 'raw',
                'value' => function($m) {
                    return $m->hoscode;
                },
            ],
            [
                'label' => 'รหัสรายงาน',
                'format' => 'raw',
                'value' => function($m) {
                    return 'R' . $m->menu_items_id;
                },
            ],
            [
                'label' => 'รายงาน',
                'format' => 'raw',
                'value' => function($m) {
                    return '<b>' . $m->items->menu_items_name . '</b>';
                },
            ],
            'create_at:date',
            //'update_at',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    //view button
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span> ลบ', $url, ['class' => 'btn btn-danger btn-xs',
                                    //'data-pjax' => 'w0',
                                    'data-confirm' => Yii::t('app', 'ยื่นยันการลบข้อมูลนี้หรือไม่?'),
                                    'data-method' => 'post',
                        ]);
                    },
                        ],
                    ],
                ],
            ]);
            ?>

</div>
