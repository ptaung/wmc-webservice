<?php

use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['action' => 'client/test/index2', 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data',]]) ?>

<?= $form->field($model, 'files')->fileInput() ?>

<button>Submit</button>

<?php ActiveForm::end() ?>

