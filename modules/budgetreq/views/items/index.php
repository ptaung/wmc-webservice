<?php

use yii\helpers\Html;
#use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'panel' => [
            //'before' => '',
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-envelope"></i> รายการ</h3>',
            'type' => 'primary',
        #'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        #'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        #'footer' => false
        ],
        'striped' => true,
        'hover' => true,
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'floatHeader' => true,
        'showPageSummary' => true,
        'pageSummaryRowOptions' => ['class' => 'kv-page-summary default'],
        'toggleDataContainer' => ['class' => 'btn-group-xs'],
        'exportContainer' => ['class' => 'btn-group-xs'],
        //'tableOptions' => ['class' => 'table table-striped table-hover tabs-stacked'],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            'items_order',
            'items_name',
            [
                'attribute' => 'items_cost',
                'format' => ['decimal', 2],
                'hAlign' => 'right',
                'pageSummary' => true
            ],
            'itemsGroup.items_group_name',
            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
