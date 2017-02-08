<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

echo DetailView::widget([
    'model' => $model,
    'condensed' => true,
    'hover' => true,
    'mode' => DetailView::MODE_VIEW,
    #'panel' => [
    #'heading' => 'รายการ # ' . $model->items->items_name,
    #'type' => DetailView::TYPE_WARNING,
    #],
    'attributes' => [
        'step_131:decimal',
        'step_132:date',
        'step_321:date',
        'step_322:decimal',
        'step_411:decimal',
        'step_412',
        'step_621:date',
        'step_622',
        'step_623:decimal',
    ],
])
?>