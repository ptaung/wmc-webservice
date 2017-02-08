<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MenuGroup */

$this->title = 'Update Menu Group: ' . ' ' . $model->menu_group_id;
$this->params['breadcrumbs'][] = ['label' => 'Menu Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->menu_group_id, 'url' => ['view', 'id' => $model->menu_group_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
