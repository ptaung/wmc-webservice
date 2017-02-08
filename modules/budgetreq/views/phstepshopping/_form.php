<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepShopping */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-step-shopping-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'items_id')->textInput() ?>

    <?= $form->field($model, 'hospcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_shopping_create')->textInput() ?>

    <?= $form->field($model, 'step_shopping_update')->textInput() ?>

    <?= $form->field($model, 'step_1')->textInput() ?>

    <?= $form->field($model, 'step_21')->textInput() ?>

    <?= $form->field($model, 'step_22')->textInput() ?>

    <?= $form->field($model, 'step_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_41')->textInput() ?>

    <?= $form->field($model, 'step_42')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_43')->textInput() ?>

    <?= $form->field($model, 'step_51')->textInput() ?>

    <?= $form->field($model, 'step_52')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_slow')->textInput() ?>

    <?= $form->field($model, 'step_comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
