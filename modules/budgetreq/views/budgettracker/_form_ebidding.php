<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepEbidding */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-step-ebiedding-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'ebieddingFormId',
                'action' => $url,
                    #'action' => 'javascript:void(0)',
                    #'enableAjaxValidation' => false,
                    #'enableClientValidation' => true,
    ]);
    ?>


    <?php #= $form->field($model, 'items_id')->textInput()      ?>

    <?php #= $form->field($model, 'hospcode')->textInput(['maxlength' => true])      ?>

    <?php #= $form->field($model, 'step_ebidding_create')->textInput()      ?>

    <?php #= $form->field($model, 'step_ebidding_update')->textInput()      ?>

    <?PHP
    switch ($step) {
        case 1:
            echo $form->field($model, 'step_11')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 2:
            echo $form->field($model, 'step_121')->textInput();
            echo $form->field($model, 'step_122')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'วันที่ ...'],
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]);
            break;
        case 3:
            echo $form->field($model, 'step_13')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 4:
            echo $form->field($model, 'step_14')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 5:
            echo $form->field($model, 'step_15')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 6:
            echo $form->field($model, 'step_211')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'วันที่ ...'],
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]);
            echo $form->field($model, 'step_212')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'วันที่ ...'],
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]);
            break;
        case 7:
            echo $form->field($model, 'step_22')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 8:
            echo $form->field($model, 'step_31')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 9:
            echo $form->field($model, 'step_32')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 10:
            echo $form->field($model, 'step_331')->textInput(['maxlength' => true]);
            echo $form->field($model, 'step_332')->textInput(['maxlength' => true]);
            break;
        case 11:
            echo $form->field($model, 'step_34')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 12:
            echo $form->field($model, 'step_35')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 13:
            echo $form->field($model, 'step_41')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 14:
            echo $form->field($model, 'step_42')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 15:
            echo $form->field($model, 'step_51')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 16:
            echo $form->field($model, 'step_521')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'วันที่ ...'],
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]);
            echo $form->field($model, 'step_522')->textInput(['maxlength' => true]);
            echo $form->field($model, 'step_523')->textInput(['maxlength' => true]);
            break;
        default:
            break;
    }
    ?>


    <?php #= $form->field($model, 'step_slow')->textInput()           ?>

    <?php #= $form->field($model, 'step_comment')->textarea(['rows' => 6])             ?>

    <div class="form-group">
        <?= Html::Button($model->isNewRecord ? 'Create' : 'บันทึกรายการ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'onclick' => 'submitform();']) ?>


    </div>
    <?php ActiveForm::end(); ?>

</div>
