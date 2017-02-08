<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Reasons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-reason-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Reason', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'reason_id',
            'reason_name',
            'reason_active',
            'reason_group_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
