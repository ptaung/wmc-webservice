<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\silasoft\models\WmcXalert */

$this->title = 'Update Wmc Xalert: ' . $model->wmc_xalert_id;
$this->params['breadcrumbs'][] = ['label' => 'Wmc Xalerts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->wmc_xalert_id, 'url' => ['view', 'id' => $model->wmc_xalert_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wmc-xalert-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
