<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhStepSpecial */

$this->title = 'Create Ph Step Special';
$this->params['breadcrumbs'][] = ['label' => 'Ph Step Specials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-step-special-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
