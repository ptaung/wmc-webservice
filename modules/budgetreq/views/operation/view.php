<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhOperation */

$this->title = $model->operation_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Operations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-operation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->operation_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->operation_id], [
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
            'operation_id',
            'operation_name',
            'operation_order',
            'operation_active',
        ],
    ]) ?>

</div>
