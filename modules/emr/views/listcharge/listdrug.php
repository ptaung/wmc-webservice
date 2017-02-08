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
            'label' => 'ชื่อยา',
            'attribute' => 'item_name',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'วิธีใช้',
            'attribute' => 'shortlist',
            'format' => 'raw',
            'visible' => 1,
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'จำนวน',
            'attribute' => 'qty',
            'visible' => 1,
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'หน่วยนับ',
            'attribute' => 'units',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
    ],
]);
