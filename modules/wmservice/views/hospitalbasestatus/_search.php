<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HospitalBaseStatusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hospital-base-status-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'hbs_hospital_id') ?>

    <?= $form->field($model, 'hbs_time') ?>

    <?= $form->field($model, 'hbs_ip') ?>

    <?= $form->field($model, 'hbs_browser') ?>

    <?= $form->field($model, 'hbs_info') ?>

    <?php // echo $form->field($model, 'hbs_secretkey') ?>

    <?php // echo $form->field($model, 'hbs_sync_start') ?>

    <?php // echo $form->field($model, 'hbs_sync_finish') ?>

    <?php // echo $form->field($model, 'hbs_status_process') ?>

    <?php // echo $form->field($model, 'hbs_error') ?>

    <?php // echo $form->field($model, 'hbs_upload_size') ?>

    <?php // echo $form->field($model, 'hbs_version') ?>

    <?php // echo $form->field($model, 'hbs_sync') ?>

    <?php // echo $form->field($model, 'hbs_update') ?>

    <?php // echo $form->field($model, 'hbs_command') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
