<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\silasoft\models\WmcProcedure */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wmc-procedure-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wmc_procedure_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wmc_procedure_seq')->textInput() ?>

    <?= $form->field($model, 'wmc_procedure_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wmc_procedure_active')->textInput() ?>

    <?= $form->field($model, 'wmc_procedure_startprocess')->textInput() ?>

    <?= $form->field($model, 'wmc_procedure_finishprocess')->textInput() ?>

    <?= $form->field($model, 'wmc_procedure_message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wmc_procedure_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wmc_procedure_querystring')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
