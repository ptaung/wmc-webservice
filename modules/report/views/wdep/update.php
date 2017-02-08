<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\report\models\Wdep */

$this->title = 'Update Wdep: ' . ' ' . $model->hoscode;
$this->params['breadcrumbs'][] = ['label' => 'Wdeps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hoscode, 'url' => ['view', 'id' => $model->hoscode]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wdep-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
