<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepDeal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-step-deal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'items_id')->textInput() ?>

    <?= $form->field($model, 'hospcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_deal_create')->textInput() ?>

    <?= $form->field($model, 'step_deal_update')->textInput() ?>

    <?= $form->field($model, 'step_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_41')->textInput() ?>

    <?= $form->field($model, 'step_42')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step_43')->textInput() ?>

    <?= $form->field($model, 'step_slow')->textInput() ?>

    <?= $form->field($model, 'step_comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
