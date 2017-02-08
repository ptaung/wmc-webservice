<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\report\models\Chospital;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\report\models\Wdep */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wdep-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'hoscode')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Chospital::Listdata(), 'hoscode', 'fullname'),
        'options' => ['placeholder' => 'เลือกสถานบริการ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, 'active')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
