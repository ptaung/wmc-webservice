<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhOperationOrder */

$this->title = 'Create Ph Operation Order';
$this->params['breadcrumbs'][] = ['label' => 'Ph Operation Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-operation-order-create">
    <?=
    $this->render('_form', [
        'model' => $model,
        'id' => $id,
        'order_id' => $order_id,
    ])
    ?>

</div>
