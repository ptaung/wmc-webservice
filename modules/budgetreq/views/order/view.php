<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhOrder */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_id',
            'items_id',
            'request_id',
            'hospcode',
            'order_name',
            'order_active',
            'order_date',
            'order_file_project:ntext',
            'order_file_cost:ntext',
            'order_file_spec:ntext',
            'order_file_breakeven:ntext',
            'order_file_etc:ntext',
            'order_reason:ntext',
            'order_priority',
            'order_amount',
        ],
    ])
    ?>

</div>
