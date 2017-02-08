<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhRequest */

$this->title = $model->request_id;
$this->params['breadcrumbs'][] = ['label' => 'Ph Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->request_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->request_id], [
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
            'request_id',
            'budget_id',
            'budget_type_id',
            'request_active',
        ],
    ])
    ?>

</div>
