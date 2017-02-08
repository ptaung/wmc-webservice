<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepSpecial */

$this->title = $model->step_special_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Step Specials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-step-special-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->step_special_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->step_special_id], [
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
            'step_special_id',
            'items_id',
            'hospcode',
            'step_special_create',
            'step_special_update',
            'step_11',
            'step_12',
            'step_131',
            'step_132',
            'step_2',
            'step_31',
            'step_321',
            'step_322',
            'step_33',
            'step_411',
            'step_412',
            'step_42',
            'step_43',
            'step_5',
            'step_61',
            'step_621',
            'step_622',
            'step_623',
            'step_slow',
            'step_comment:ntext',
        ],
    ]) ?>

</div>
