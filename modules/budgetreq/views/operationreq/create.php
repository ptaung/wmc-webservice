<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhOperationRequest */

$this->title = 'Create Ph Operation Request';
$this->params['breadcrumbs'][] = ['label' => 'Ph Operation Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-operation-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form2', [
        'model' => $model,
        'duallistbox' => $duallistbox,
    ])
    ?>

</div>
