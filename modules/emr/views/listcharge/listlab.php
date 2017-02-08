<?php

use kartik\grid\GridView;

echo GridView::widget([
    'export' => false,
    'id' => 'GridView_report',
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'toolbar' => [
        [
            '{toggleData}',
            'options' => ['class' => 'btn-group btn-group-sm'],
        ],
        '{export} {toggleData}',
    ],
    'layout' => "{items}",
    'floatHeader' => true,
    'responsive' => true,
    'hover' => true,
    'responsiveWrap' => false,
    'pjax' => true,
    'dataProvider' => $dataProvider,
    'showPageSummary' => false,
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'label' => 'FBS',
            'attribute' => 'fbs',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'HbA1C',
            'attribute' => 'hba1c',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'Triglyceride',
            'attribute' => 'tg',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'Total Cholesterol',
            'attribute' => 'tc',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'eGFR',
            'attribute' => 'egfr',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'LDL',
            'attribute' => 'ldl',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'HDL',
            'attribute' => 'hdl',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'creatinine',
            'attribute' => 'creatinine',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
    ],
]);
