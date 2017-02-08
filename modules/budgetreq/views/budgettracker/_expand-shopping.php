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
        'step_1:decimal',
        'step_21:date',
        'step_22:date',
        'step_41:date',
        'step_42',
        'step_43:decimal',
        'step_51:date',
        'step_52',
    ],
])
?>