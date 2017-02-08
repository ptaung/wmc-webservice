<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\report\models\WuseItems */

$this->title = 'Update Wuse Items: ' . ' ' . $model->hoscode;
$this->params['breadcrumbs'][] = ['label' => 'Wuse Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hoscode, 'url' => ['view', 'hoscode' => $model->hoscode, 'menu_items_id' => $model->menu_items_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wuse-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'dataProvider_rpt' => $dataProvider_rpt,
    ])
    ?>

</div>
