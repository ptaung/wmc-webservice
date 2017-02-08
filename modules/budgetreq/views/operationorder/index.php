<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Operation Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-operation-order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Operation Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'operation_order_id',
            'operation_request_id',
            'order_id',
            'operation_order_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
