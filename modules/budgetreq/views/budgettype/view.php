<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhBudgetType */

$this->title = $model->budget_type_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Budget Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-budget-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->budget_type_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->budget_type_id], [
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
            'budget_type_id',
            'budget_type_name',
            'budget_type_order',
            'budget_type_active',
        ],
    ]) ?>

</div>
