<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhItemsGroup */

$this->title = $model->items_group_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Items Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-items-group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->items_group_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->items_group_id], [
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
            'items_group_id',
            'items_group_name',
            'items_group_order',
            'items_group_active',
            'items_mastergroup_id',
        ],
    ]) ?>

</div>
