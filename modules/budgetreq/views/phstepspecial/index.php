<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Step Specials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-step-special-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Step Special', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    Pjax::begin();    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'step_special_id',
            'items_id',
            'hospcode',
            'step_special_create',
            'step_special_update',
            // 'step_11',
            // 'step_12',
            // 'step_131',
            // 'step_132',
            // 'step_2',
            // 'step_31',
            // 'step_321',
            // 'step_322',
            // 'step_33',
            // 'step_411',
            // 'step_412',
            // 'step_42',
            // 'step_43',
            // 'step_5',
            // 'step_61',
            // 'step_621',
            // 'step_622',
            // 'step_623',
            // 'step_slow',
            // 'step_comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    Pjax::end();</div>
