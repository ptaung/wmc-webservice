<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhHospcode */

$this->title = 'Update Ph Hospcode: ' . ' ' . $model->hospcode;
$this->params['breadcrumbs'][] = ['label' => 'Ph Hospcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hospcode, 'url' => ['view', 'id' => $model->hospcode]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-hospcode-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
