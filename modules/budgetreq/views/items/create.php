<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhItems */

$this->title = 'Create Ph Items';
$this->params['breadcrumbs'][] = ['label' => 'Ph Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
