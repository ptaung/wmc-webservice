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
        'step_121:decimal',
        'step_122:date',
        'step_211:date',
        'step_212:date',
        'step_331:decimal',
        'step_332',
        'step_521:date',
        'step_522',
        'step_523:decimal',
    ],
])
?>