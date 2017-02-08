<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\budgetreq\models\PhItemsMastergroup;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhItemsGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-items-group-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'items_group_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'items_mastergroup_id')->dropDownList(ArrayHelper::map(PhItemsMastergroup::find()->all(), 'items_mastergroup_id', 'items_mastergroup_name'), ['prompt' => '--เลือกรายการ--']) ?>
    <?= $form->field($model, 'items_group_active')->dropDownList(['1' => 'ใช้งาน', '0' => 'ไม่ใช้งาน']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
