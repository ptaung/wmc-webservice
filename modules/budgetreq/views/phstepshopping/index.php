<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Step Shoppings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-step-shopping-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Step Shopping', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    Pjax::begin();    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'step_shopping_id',
            'items_id',
            'hospcode',
            'step_shopping_create',
            'step_shopping_update',
            // 'step_1',
            // 'step_21',
            // 'step_22',
            // 'step_3',
            // 'step_41',
            // 'step_42',
            // 'step_43',
            // 'step_51',
            // 'step_52',
            // 'step_slow',
            // 'step_comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    Pjax::end();</div>
