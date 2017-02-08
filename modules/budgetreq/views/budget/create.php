<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhBudget */

$this->title = 'Create Ph Budget';
$this->params['breadcrumbs'][] = ['label' => 'Ph Budgets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-budget-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
