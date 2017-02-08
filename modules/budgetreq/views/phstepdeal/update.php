<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepDeal */

$this->title = 'Update Ph Step Deal: ' . ' ' . $model->step_deal_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Step Deals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->step_deal_id, 'url' => ['view', 'id' => $model->step_deal_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-step-deal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
