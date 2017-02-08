<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Budget Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-budget-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Budget Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'budget_type_id',
            'budget_type_name',
            'budget_type_order',
            'budget_type_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
