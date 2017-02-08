<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhItemsMastergroup */

$this->title = 'Update Ph Items Mastergroup: ' . ' ' . $model->items_mastergroup_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Items Mastergroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->items_mastergroup_id, 'url' => ['view', 'id' => $model->items_mastergroup_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-items-mastergroup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
