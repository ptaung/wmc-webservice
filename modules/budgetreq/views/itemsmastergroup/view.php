<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhItemsMastergroup */

$this->title = $model->items_mastergroup_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Items Mastergroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-items-mastergroup-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->items_mastergroup_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->items_mastergroup_id], [
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
            'items_mastergroup_id',
            'items_mastergroup_name',
            'items_mastergroup_order',
            'items_mastergroup_active',
        ],
    ]) ?>

</div>
