<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhHospcode */

$this->title = 'Create Ph Hospcode';
$this->params['breadcrumbs'][] = ['label' => 'Ph Hospcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-hospcode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
