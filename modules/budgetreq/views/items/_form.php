<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\budgetreq\models\PhItemsGroup;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-items-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'items_order')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'items_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'items_group_id')->dropDownList(ArrayHelper::map(PhItemsGroup::find()->all(), 'items_group_id', 'items_group_name'), ['prompt' => '--เลือกรายการ--']) ?>
    <?= $form->field($model, 'items_cost')->textInput() ?>
    <?= $form->field($model, 'items_active')->dropDownList(['1' => 'ใช้งาน', '0' => 'ไม่ใช้งาน']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
