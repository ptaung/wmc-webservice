<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepSpecial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-step-special-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'items_id')->textInput() ?>

    <?= $form->field($model, 'hospcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_special_create')->textInput() ?>

    <?= $form->field($model, 'step_special_update')->textInput() ?>

    <?= $form->field($model, 'step_11')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_12')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_131')->textInput() ?>

    <?= $form->field($model, 'step_132')->textInput() ?>

    <?= $form->field($model, 'step_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_31')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_321')->textInput() ?>

    <?= $form->field($model, 'step_322')->textInput() ?>

    <?= $form->field($model, 'step_33')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_411')->textInput() ?>

    <?= $form->field($model, 'step_412')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_42')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_43')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_61')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_621')->textInput() ?>

    <?= $form->field($model, 'step_622')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_623')->textInput() ?>

    <?= $form->field($model, 'step_slow')->textInput() ?>

    <?= $form->field($model, 'step_comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
