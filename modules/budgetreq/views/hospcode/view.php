<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhHospcode */

$this->title = $model->hospcode;
$this->params['breadcrumbs'][] = ['label' => 'Ph Hospcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-hospcode-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->hospcode], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->hospcode], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'hospcode',
            'hospcode_name',
            'hospcode_active',
        ],
    ]) ?>

</div>
