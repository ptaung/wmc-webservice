<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
?>

<div class="ph-step-ebiedding-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'ebieddingFormId',
                'action' => $url,
    ]);
    ?>

    <?PHP
    switch ($step) {
        case 1:
            echo $form->field($model, 'step_1')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 2:
            echo $form->field($model, 'step_2')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 3:
            echo $form->field($model, 'step_3')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'วันที่ ...'], 'type' => DatePicker::TYPE_COMPONENT_APPEND, 'language' => 'th', 'pluginOptions' => [ 'autoclose' => true, 'todayHighlight' => true, 'format' => 'yyyy-mm-dd',]]);
            break;
        case 4:
            echo $form->field($model, 'step_41')->textInput();
            echo $form->field($model, 'step_42')->textInput();
            echo $form->field($model, 'step_43')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'วันที่ ...'],
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]);
            echo $form->field($model, 'step_44')->textInput();
            break;

        default:
            break;
    }
    ?>


    <?php #= $form->field($model, 'step_slow')->textInput()              ?>

    <?php #= $form->field($model, 'step_comment')->textarea(['rows' => 6])                ?>

    <div class="form-group">
        <?= Html::Button($model->isNewRecord ? 'Create' : 'บันทึกรายการ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'onclick' => 'submitform();']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
