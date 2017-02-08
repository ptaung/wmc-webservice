<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepSpecial */

$this->title = 'Update Ph Step Special: ' . ' ' . $model->step_special_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Step Specials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->step_special_id, 'url' => ['view', 'id' => $model->step_special_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-step-special-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
