<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhBudget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-budget-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'budget_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'budget_order')->textInput() ?>

    <?= $form->field($model, 'budget_active')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
