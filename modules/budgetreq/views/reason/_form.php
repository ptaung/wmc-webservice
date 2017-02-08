<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\budgetreq\models\PhReasonGroup;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhReason */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-reason-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reason_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reason_group_id')->dropDownList(ArrayHelper::map(PhReasonGroup::find()->all(), 'reason_group_id', 'reason_group_name'), ['prompt' => '--เลือกรายการ--']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
