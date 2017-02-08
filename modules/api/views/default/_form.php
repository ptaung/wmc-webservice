<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'news_header')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'news_detail')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ])
    ?>
    <?php
// usage without model
    echo '<label>Check Issue Date</label>';
    echo DatePicker::widget([
        'model' => $model,
        'name' => 'news_date',
        'attribute' => 'news_date',
        'value' => date('Y-m-d'),
        'options' => ['placeholder' => 'Select issue date ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]);
    ?>

    <?php # $form->field($model, 'news_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'สร้างใหม่' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
