<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhReasonGroup */

$this->title = $model->reason_group_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Reason Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-reason-group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->reason_group_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->reason_group_id], [
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
            'reason_group_id',
            'reason_group_name',
            'reason_group_active',
        ],
    ]) ?>

</div>
