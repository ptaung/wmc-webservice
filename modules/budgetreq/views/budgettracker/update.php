<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepEbidding */

$this->title = 'Update Ph Step Ebidding: ' . ' ' . $model->step_ebidding_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Step Ebiddings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->step_ebidding_id, 'url' => ['view', 'id' => $model->step_ebidding_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-step-ebidding-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
