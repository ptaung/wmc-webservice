<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Hospcodes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-hospcode-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Hospcode', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'hospcode',
            'hospcode_name',
            'hospcode_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
