<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhOperation */

$this->title = 'Update Ph Operation: ' . ' ' . $model->operation_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Operations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->operation_id, 'url' => ['view', 'id' => $model->operation_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-operation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
