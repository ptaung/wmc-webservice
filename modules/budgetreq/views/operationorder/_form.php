<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\budgetreq\models\PhOperationRequest;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhOperationOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-operation-order-form">

    <?php yii\widgets\Pjax::begin(['id' => 'PhOperationRequest']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'operation_request_id')->dropDownList(ArrayHelper::map(PhOperationRequest::find()->where(['request_id' => $id])->all(), 'operation_request_id', 'fullname'), ['prompt' => '--เลือกรายการ--']) ?>

    <?=
    $form->field($model, 'operation_order_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => ''],
        'language' => 'th-TH',
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <?= $form->field($model, 'operation_order_number')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึกรายการ' : 'แก้ไขรายการ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php yii\widgets\Pjax::end() ?>

</div>
