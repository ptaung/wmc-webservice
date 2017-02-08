<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Reason Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-reason-group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Reason Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'reason_group_id',
            'reason_group_name',
            'reason_group_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
