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
        'step_41:decimal',
        'step_42',
        'step_43:date',
        'step_44',
    ],
])
?>