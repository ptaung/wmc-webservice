<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MenuGroup */

$this->title = $model->menu_group_id;
$this->params['breadcrumbs'][] = ['label' => 'Menu Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->menu_group_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->menu_group_id], [
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
            'menu_group_id',
            'menu_group_name',
            'menu_group_active',
            'menu_group_comment:ntext',
        ],
    ]) ?>

</div>
