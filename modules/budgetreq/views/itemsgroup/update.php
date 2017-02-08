<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhItemsGroup */

$this->title = 'Update Ph Items Group: ' . ' ' . $model->items_group_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Items Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->items_group_id, 'url' => ['view', 'id' => $model->items_group_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ph-items-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
