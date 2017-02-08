<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\silasoft\models\WmcXalert */

$this->title = $model->wmc_xalert_id;
$this->params['breadcrumbs'][] = ['label' => 'Wmc Xalerts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wmc-xalert-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->wmc_xalert_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->wmc_xalert_id], [
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
            'wmc_xalert_id',
            'wmc_xalert_active',
            'wmc_xalert_title',
            'wmc_xalert_query:ntext',
            'wmc_xalert_status',
            'wmc_xalert_orderby',
            'wmc_xalert_querytype',
            'wmc_xalert_start',
            'wmc_xalert_finish',
            'wmc_xalert_message',
            'wmc_xalert_name',
        ],
    ]) ?>

</div>
