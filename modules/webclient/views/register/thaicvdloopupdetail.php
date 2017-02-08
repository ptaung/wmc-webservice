<?php

use kartik\grid\GridView;
use app\modules\webclient\components\Cwebclient;

#use app\modules\webclient\components\Cwebclient;

echo GridView::widget([
#'caption' => $menu['menu_items_name'],
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
    #'floatHeader' => true,
    'responsive' => true,
    'hover' => true,
    'responsiveWrap' => false,
    'pjax' => true,
    'dataProvider' => $dataProvider,
    'showPageSummary' => false,
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'label' => 'HOSCODE',
            'attribute' => 'hospcode',
            'format' => 'raw',
        ],
        [
            'label' => 'VN',
            'attribute' => 'vn',
            'format' => 'raw',
        ],
        [
            'label' => 'อายุ',
            'attribute' => 'ageatservice',
            'format' => 'raw',
        ],
        [
            'label' => 'ความดัน',
            'attribute' => 'bps',
            'format' => ['decimal', 0]
        ],
        [
            'label' => 'ส่วนสูง',
            'attribute' => 'height',
            'format' => ['decimal', 0]
        ],
        [
            'label' => 'รอบเอว',
            'attribute' => 'waist',
            'format' => ['decimal', 0]
        ],
        [
            'label' => 'สูบบุรี่',
            'attribute' => 'smoking',
            'value' => function($data) {
                return ($data['smoking'] == 1 ? "สูบ" : ($data['smoking'] == 0 ? "ไม่สูบ" : 'ไม่ระบุ'));
            },
        ],
        [
            'label' => 'Tc',
            'attribute' => 'tc',
        ],
        [
            'label' => 'วันที่รับบริการ',
            'attribute' => 'vstdate',
            'format' => 'raw',
            'value' => function($data) {
                return Cwebclient::getThaiDate($data['vstdate'], 'S', 1);
            }
        ],
        [
            'label' => 'สิทธิการรักษา',
            'attribute' => 'intype',
        ],
    ],
]);
