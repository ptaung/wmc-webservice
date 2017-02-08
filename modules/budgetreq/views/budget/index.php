<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Budgets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-budget-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Budget', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'budget_id',
            'budget_name',
            'budget_order',
            'budget_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
