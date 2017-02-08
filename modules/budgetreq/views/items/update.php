<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhItems */

$this->title = 'Update Ph Items: ' . ' ' . $model->items_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->items_id, 'url' => ['view', 'id' => $model->items_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
