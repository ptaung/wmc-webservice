<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HospitalBaseStatus */

$this->title = 'Update Hospital Base Status: ' . ' ' . $model->hbs_hospital_id;
$this->params['breadcrumbs'][] = ['label' => 'Hospital Base Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hbs_hospital_id, 'url' => ['view', 'id' => $model->hbs_hospital_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hospital-base-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
