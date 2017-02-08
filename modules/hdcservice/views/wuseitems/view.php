<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\report\models\WuseItems */

$this->title = $model->hoscode;
$this->params['breadcrumbs'][] = ['label' => 'Wuse Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wuse-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'hoscode' => $model->hoscode, 'menu_items_id' => $model->menu_items_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'hoscode' => $model->hoscode, 'menu_items_id' => $model->menu_items_id], [
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
            'hoscode',
            'menu_items_id',
            'create_at',
            'update_at',
        ],
    ]) ?>

</div>
