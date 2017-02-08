<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepEbidding */

$this->title = $model->step_ebidding_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Step Ebiddings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-step-ebidding-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->step_ebidding_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->step_ebidding_id], [
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
            'step_ebidding_id',
            'items_id',
            'hospcode',
            'step_ebidding_create',
            'step_ebidding_update',
            'step_11',
            'step_121',
            'step_122',
            'step_13',
            'step_14',
            'step_15',
            'step_211',
            'step_212',
            'step_22',
            'step_31',
            'step_32',
            'step_331',
            'step_332',
            'step_34',
            'step_35',
            'step_41',
            'step_42',
            'step_51',
            'step_521',
            'step_522',
            'step_523',
            'step_slow',
            'step_comment:ntext',
        ],
    ]) ?>

</div>
