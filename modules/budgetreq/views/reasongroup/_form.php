<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhReasonGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-reason-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reason_group_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reason_group_active')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
