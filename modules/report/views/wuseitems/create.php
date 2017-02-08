<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\report\models\WuseItems */

$this->title = 'รายงานสำหรับหน่วยงาน';
$this->params['breadcrumbs'][] = ['label' => 'Wuse Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wuse-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'dataProvider_rpt' => $dataProvider_rpt,
    ])
    ?>

</div>
