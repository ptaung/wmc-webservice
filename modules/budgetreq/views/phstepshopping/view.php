<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepShopping */

$this->title = $model->step_shopping_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Step Shoppings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-step-shopping-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->step_shopping_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->step_shopping_id], [
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
            'step_shopping_id',
            'items_id',
            'hospcode',
            'step_shopping_create',
            'step_shopping_update',
            'step_1',
            'step_21',
            'step_22',
            'step_3',
            'step_41',
            'step_42',
            'step_43',
            'step_51',
            'step_52',
            'step_slow',
            'step_comment:ntext',
        ],
    ]) ?>

</div>
