<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\budgetreq\models\PhRequest;
use app\modules\budgetreq\models\PhOperation;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhOperationRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-operation-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'request_id')->dropDownList(ArrayHelper::map(PhRequest::find()->all(), 'request_id', 'fullname', 'budget.budget_name'), ['prompt' => '--เลือกรายการ--']) ?>
    <?= $form->field($model, 'operation_id')->dropDownList(ArrayHelper::map(PhOperation::find()->all(), 'operation_id', 'fullname'), ['prompt' => '--เลือกรายการ--']) ?>

    <!--
        <div class="row">
    <?php
    /*
      echo maksyutin\duallistbox\Widget::widget([
      'model' => $model,
      'attribute' => 'request_center_detail',
      'title' => '9876554',
      'data' => $duallistbox,
      'data_id' => 'operation_id',
      'data_value' => 'operation_name',
      'lngOptions' => [
      #'warning_info' => 'ss',
      'search_placeholder' => 'เลือกข้อมูล',
      #'showing' => '123456',
      'available' => 'รายการทั้งหมด',
      'selected' => 'เลือกแล้ว'
      ]
      ]);
     *
     */
    ?>
        </div>
    -->
    <?= $form->field($model, 'request_center_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'request_local_detail')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
