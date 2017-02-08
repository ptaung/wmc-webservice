<?php

use kartik\grid\GridView;
use app\modules\webclient\components\Cwebclient;

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
            'label' => 'วันที่/เวลา',
            'attribute' => 'vstdate',
            'format' => 'datetime',
            #'value' => function($data) {
            # return Cwebclient::getThaiDate($data['vstdate'], 'S', true);
            #return $data['vstdate'];
            #},
            'contentOptions' => ['class' => 'small text-left'],
        ],
        [
            'label' => 'หน่วยบริการ',
            'attribute' => 'hname',
            'format' => 'raw',
            'contentOptions' => ['class' => 'small text-left'],
        ],
        [
            'label' => '#',
            'value' => function($data) {
                return '<a href="javascript:;" class="label label-default" onClick="getListDetail(\'' . $data["hospcode"] . '\',\'' . $data["hn"] . '\',\'' . $data["vn"] . '\')">เปิด</a>';
            },
            'format' => 'raw',
            'contentOptions' => ['class' => 'small  text-center'],
        ],
    ],
]);
