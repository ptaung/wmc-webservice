<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepShopping */

$this->title = 'Update Ph Step Shopping: ' . ' ' . $model->step_shopping_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Step Shoppings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->step_shopping_id, 'url' => ['view', 'id' => $model->step_shopping_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-step-shopping-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
