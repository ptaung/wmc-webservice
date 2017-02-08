<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MenuGroup */

$this->title = 'Create Menu Group';
$this->params['breadcrumbs'][] = ['label' => 'Menu Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-group-create">

    <div class="alert alert-dismissible  alert-warning">
        <b><?= Html::encode($this->title) ?></b>
    </div>
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
