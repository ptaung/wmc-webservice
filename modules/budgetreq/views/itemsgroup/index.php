<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Items Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-items-group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Items Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'items_group_id',
            'items_group_name',
            'items_group_order',
            'items_group_active',
            'items_mastergroup_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
