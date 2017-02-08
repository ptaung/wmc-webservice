<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HospitalBaseStatus */

$this->title = 'Create Hospital Base Status';
$this->params['breadcrumbs'][] = ['label' => 'Hospital Base Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-base-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
