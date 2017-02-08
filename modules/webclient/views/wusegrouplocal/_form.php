<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\webclient\models\WuseGroupLocal;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\MenuGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'menu_group_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_group_submenu')->dropDownList(ArrayHelper::map(WuseGroupLocal::find()->all(), 'menu_group_id', 'menu_group_name'), ['prompt' => '--เลือกรายการ--']) ?>

    <?= $form->field($model, 'menu_group_active')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_group_comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
