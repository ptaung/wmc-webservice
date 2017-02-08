<?php

use kartik\grid\GridView;

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
            'label' => 'เลขบัตรประชาชน',
            'attribute' => 'cid',
            'format' => 'raw',
            'visible' => 0,
            // 'value' => '$data["vstdate"]." ".$data["vsttime"]',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'ชื่อ-สกุล',
            'attribute' => 'fullname',
            'visible' => 1,
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'HN',
            'attribute' => 'hn',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'หน่วยบริการ',
            'attribute' => 'hname',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'ประเภทการอาศัย',
            'attribute' => 'house_regist_type_id',
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => 'แก้ไขล่าสุด',
            'attribute' => 'last_update',
            'format' => 'raw',
            'visible' => 0,
            'contentOptions' => ['class' => 'text-left'],
        ],
        [
            'label' => '#',
            'value' => function($data) {
                return '<a href="javascript:;" class="label label-primary" onClick="getListPersonDetail(\'' . $data["hospcode"] . '\',\'' . $data["cid"] . '\')">เปิด</a>';
            },
            'format' => 'raw',
            'contentOptions' => ['class' => 'text-center'],
        ],
    ],
]);
