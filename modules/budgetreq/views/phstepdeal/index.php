<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Step Deals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-step-deal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Step Deal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    Pjax::begin();    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'step_deal_id',
            'items_id',
            'hospcode',
            'step_deal_create',
            'step_deal_update',
            // 'step_1',
            // 'step_2',
            // 'step_3',
            // 'step_41',
            // 'step_42',
            // 'step_43',
            // 'step_slow',
            // 'step_comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    Pjax::end();</div>
