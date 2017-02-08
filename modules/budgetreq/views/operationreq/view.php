<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhOperationRequest */

$this->title = $model->operation_request_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Operation Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-operation-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->operation_request_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->operation_request_id], [
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
            'operation_request_id',
            'operation_id',
            'request_id',
            'request_center_detail:ntext',
            'request_local_detail:ntext',
        ],
    ]) ?>

</div>
