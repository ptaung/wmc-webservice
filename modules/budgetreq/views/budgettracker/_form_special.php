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
            echo $form->field($model, 'step_12')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 3:
            echo $form->field($model, 'step_132')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'วันที่ ...'],
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]);
            echo $form->field($model, 'step_131')->textInput();
            break;
        case 4:
            echo $form->field($model, 'step_2')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 5:
            echo $form->field($model, 'step_31')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 6:
            echo $form->field($model, 'step_321')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'วันที่ ...'],
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]);
            echo $form->field($model, 'step_322')->textInput();
            break;
        case 7:
            echo $form->field($model, 'step_33')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 8:
            echo $form->field($model, 'step_411')->textInput(['maxlength' => true]);
            echo $form->field($model, 'step_412')->textInput(['maxlength' => true]);
            break;
        case 9:
            echo $form->field($model, 'step_42')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 10:
            echo $form->field($model, 'step_43')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 11:
            echo $form->field($model, 'step_5')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 12:
            echo $form->field($model, 'step_61')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 13:
            echo $form->field($model, 'step_621')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'วันที่ ...'],
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]);
            echo $form->field($model, 'step_622')->textInput(['maxlength' => true]);
            echo $form->field($model, 'step_623')->textInput(['maxlength' => true]);
            break;
        default:
            break;
    }
    ?>


    <?php #= $form->field($model, 'step_slow')->textInput()            ?>

    <?php #= $form->field($model, 'step_comment')->textarea(['rows' => 6])              ?>

    <div class="form-group">
        <?= Html::Button($model->isNewRecord ? 'Create' : 'บันทึกรายการ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'onclick' => 'submitform();']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
