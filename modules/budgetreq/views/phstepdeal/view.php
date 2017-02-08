<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepDeal */

$this->title = $model->step_deal_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Step Deals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-step-deal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->step_deal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->step_deal_id], [
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
            'step_deal_id',
            'items_id',
            'hospcode',
            'step_deal_create',
            'step_deal_update',
            'step_1',
            'step_2',
            'step_3',
            'step_41',
            'step_42',
            'step_43',
            'step_slow',
            'step_comment:ntext',
        ],
    ]) ?>

</div>
