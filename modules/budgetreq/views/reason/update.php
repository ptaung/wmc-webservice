<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhReason */

$this->title = 'Update Ph Reason: ' . ' ' . $model->reason_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Reasons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->reason_id, 'url' => ['view', 'id' => $model->reason_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-reason-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
