<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HospitalBaseStatus */

$this->title = $model->hbs_hospital_id;
$this->params['breadcrumbs'][] = ['label' => 'Hospital Base Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-base-status-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->hbs_hospital_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->hbs_hospital_id], [
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
            'hbs_hospital_id',
            'hbs_time',
            'hbs_ip',
            'hbs_browser',
            'hbs_info',
            'hbs_secretkey',
            'hbs_sync_start',
            'hbs_sync_finish',
            'hbs_status_process',
            'hbs_error',
            'hbs_upload_size',
            'hbs_version',
            'hbs_sync',
            'hbs_update',
            'hbs_command:ntext',
        ],
    ]) ?>

</div>
