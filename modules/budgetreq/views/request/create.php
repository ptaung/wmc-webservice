<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhRequest */

$this->title = 'Create Ph Request';
$this->params['breadcrumbs'][] = ['label' => 'Ph Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
