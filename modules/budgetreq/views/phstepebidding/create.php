<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepEbidding */

$this->title = 'Create Ph Step Ebidding';
$this->params['breadcrumbs'][] = ['label' => 'Ph Step Ebiddings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-step-ebidding-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
