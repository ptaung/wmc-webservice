<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhReasonGroup */

$this->title = 'Update Ph Reason Group: ' . ' ' . $model->reason_group_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Reason Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->reason_group_id, 'url' => ['view', 'id' => $model->reason_group_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-reason-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
