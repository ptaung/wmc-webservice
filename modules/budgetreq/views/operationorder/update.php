<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhOperationOrder */

$this->title = 'Update Ph Operation Order: ' . ' ' . $model->operation_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Operation Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->operation_order_id, 'url' => ['view', 'id' => $model->operation_order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-operation-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
