<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Items Mastergroups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-items-mastergroup-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Items Mastergroup', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'items_mastergroup_id',
            'items_mastergroup_name',
            'items_mastergroup_order',
            'items_mastergroup_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
