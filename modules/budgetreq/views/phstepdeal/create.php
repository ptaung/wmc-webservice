<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepDeal */

$this->title = 'Create Ph Step Deal';
$this->params['breadcrumbs'][] = ['label' => 'Ph Step Deals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-step-deal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
