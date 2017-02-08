<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\budgetreq\models\PhBudget;
use app\modules\budgetreq\models\PhBudgetType;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'budget_id')->dropDownList(ArrayHelper::map(PhBudget::find()->all(), 'budget_id', 'budget_name'), ['prompt' => '--เลือกรายการ--']) ?>

    <?= $form->field($model, 'budget_type_id')->dropDownList(ArrayHelper::map(PhBudgetType::find()->all(), 'budget_type_id', 'budget_type_name'), ['prompt' => '--เลือกรายการ--']) ?>

    <?= $form->field($model, 'request_active')->dropDownList(['1' => 'ใช้งาน', '0' => 'ไม่ใช้งาน']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
