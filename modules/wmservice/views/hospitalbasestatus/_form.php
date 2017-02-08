<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HospitalBaseStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hospital-base-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hbs_hospital_id')->textInput(['maxlength' => true]) ?>

    <?php #= $form->field($model, 'hbs_time')->textInput() ?>

    <?php #= $form->field($model, 'hbs_ip')->textInput(['maxlength' => true]) ?>

    <?php #= $form->field($model, 'hbs_browser')->textInput(['maxlength' => true]) ?>

    <?php #= $form->field($model, 'hbs_info')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hbs_secretkey')->textInput(['maxlength' => true]) ?>

    <?php #= $form->field($model, 'hbs_sync_start')->textInput() ?>

    <?php #= $form->field($model, 'hbs_sync_finish')->textInput() ?>

    <?php #= $form->field($model, 'hbs_status_process')->textInput(['maxlength' => true]) ?>

    <?php #= $form->field($model, 'hbs_error')->textInput(['maxlength' => true]) ?>

    <?php #= $form->field($model, 'hbs_upload_size')->textInput() ?>

    <?php #= $form->field($model, 'hbs_version')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hbs_sync')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hbs_update')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hbs_command')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
