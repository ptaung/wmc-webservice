<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhItemsMastergroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-items-mastergroup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'items_mastergroup_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'items_mastergroup_order')->textInput() ?>

    <?= $form->field($model, 'items_mastergroup_active')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
