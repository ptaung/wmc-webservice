<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhBudgetType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-budget-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'budget_type_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'budget_type_order')->textInput() ?>

    <?= $form->field($model, 'budget_type_active')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
