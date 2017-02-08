<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\silasoft\models\WmcXalert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wmc-xalert-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wmc_xalert_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wmc_xalert_active')->textInput() ?>

    <?= $form->field($model, 'wmc_xalert_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wmc_xalert_query')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wmc_xalert_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wmc_xalert_orderby')->textInput() ?>

    <?= $form->field($model, 'wmc_xalert_querytype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wmc_xalert_start')->textInput() ?>

    <?= $form->field($model, 'wmc_xalert_finish')->textInput() ?>

    <?= $form->field($model, 'wmc_xalert_message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wmc_xalert_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
