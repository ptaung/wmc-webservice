<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhOperationRequest */

$this->title = 'Update Ph Operation Request: ' . ' ' . $model->operation_request_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Operation Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->operation_request_id, 'url' => ['view', 'id' => $model->operation_request_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-operation-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'duallistbox' => $duallistbox,
    ])
    ?>

</div>
