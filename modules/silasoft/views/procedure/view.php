<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\silasoft\models\WmcProcedure */

$this->title = $model->wmc_procedure_name;
$this->params['breadcrumbs'][] = ['label' => 'Wmc Procedures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wmc-procedure-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->wmc_procedure_name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->wmc_procedure_name], [
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
            'wmc_procedure_name',
            'wmc_procedure_seq',
            'wmc_procedure_comment:ntext',
            'wmc_procedure_active',
            'wmc_procedure_startprocess',
            'wmc_procedure_finishprocess',
            'wmc_procedure_message:ntext',
            'wmc_procedure_status',
            'wmc_procedure_querystring:ntext',
        ],
    ]) ?>

</div>
