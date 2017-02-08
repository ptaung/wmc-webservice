<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Operations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-operation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Operation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'operation_id',
            'operation_name',
            'operation_order',
            'operation_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
