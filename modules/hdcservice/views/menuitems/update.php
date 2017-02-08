<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MenuItems */

$this->title = 'แก้ไขรายการที่ : ' . ' ' . $model->menu_items_id;
$this->params['breadcrumbs'][] = ['label' => 'เมนู', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->menu_items_id, 'url' => ['view', 'id' => $model->menu_items_id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="menu-items-update">
    <div class="alert alert-dismissible  alert-warning">
        <b><?= Html::encode($this->title) ?></b>
    </div>
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
