<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\silasoft\models\WmcXalert */

$this->title = 'Create Wmc Xalert';
$this->params['breadcrumbs'][] = ['label' => 'Wmc Xalerts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wmc-xalert-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
