<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\report\models\Wdep */

$this->title = 'Create Wdep';
$this->params['breadcrumbs'][] = ['label' => 'Wdeps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wdep-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
