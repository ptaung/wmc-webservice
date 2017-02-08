<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\silasoft\models\WmcProcedure */

$this->title = 'Update Wmc Procedure: ' . $model->wmc_procedure_name;
$this->params['breadcrumbs'][] = ['label' => 'Wmc Procedures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->wmc_procedure_name, 'url' => ['view', 'id' => $model->wmc_procedure_name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wmc-procedure-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
