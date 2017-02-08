<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhBudgetType */

$this->title = 'Create Ph Budget Type';
$this->params['breadcrumbs'][] = ['label' => 'Ph Budget Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-budget-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
