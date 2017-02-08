<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhItems */

$this->title = $model->items_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->items_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->items_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'items_id',
            'items_name',
            'items_order',
            'items_active',
            'items_group_id',
            'items_cost',
        ],
    ]) ?>

</div>
