<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepEbidding */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-step-ebidding-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'items_id')->textInput() ?>

    <?= $form->field($model, 'hospcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_ebidding_create')->textInput() ?>

    <?= $form->field($model, 'step_ebidding_update')->textInput() ?>

    <?= $form->field($model, 'step_11')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_121')->textInput() ?>

    <?= $form->field($model, 'step_122')->textInput() ?>

    <?= $form->field($model, 'step_13')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_14')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_15')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_211')->textInput() ?>

    <?= $form->field($model, 'step_212')->textInput() ?>

    <?= $form->field($model, 'step_22')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_31')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_32')->textInput() ?>

    <?= $form->field($model, 'step_331')->textInput() ?>

    <?= $form->field($model, 'step_332')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_34')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_35')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_41')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_42')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_51')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_521')->textInput() ?>

    <?= $form->field($model, 'step_522')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_523')->textInput() ?>

    <?= $form->field($model, 'step_slow')->textInput() ?>

    <?= $form->field($model, 'step_comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
