<?php

#use yii\helpers\Html;

use kartik\grid\GridView;
use app\modules\webclient\components\Cwebclient;

#use yii\widgets\Pjax;
?>

<?=

GridView::widget([

    'export' => FALSE,
    'responsiveWrap' => false,
    'layout' => '<div class="box box-success">
<div class="box-header with-border">
<i class="fa fa-fw fa-list-ul" style="color: #1E8000;"></i> <b>ข้อมูลการได้รับวัคซีน</b>
<div class="box-tools pull-right">{summary}</div>
</div>
<div class="box-body">
{items}{pager}
</div>
</div>',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'หน่วยบริการ',
            'attribute' => 'hospcode',
        ],
        [
            'label' => 'วันที่ให้บริการ',
            'attribute' => 'service_date',
            'format' => 'raw',
            'value' => function($data) {
                return Cwebclient::getThaiDate($data['service_date']);
            }
        ],
        [
            'label' => 'รหัสวัคซีน',
            'attribute' => 'vaccine_type',
        ],
        [
            'label' => 'ชื่อวัคซีน',
            'attribute' => 'thvaccine',
            'value' => function($data) {
                return $data['engvaccine'] . ' (' . $data['thvaccine'] . ')';
            },
        ],
        [
            'label' => 'ได้รับวัคซีนจาก',
            'attribute' => 'vaccine_hospcode',
        ],
        [
            'label' => 'lotno',
            'attribute' => 'vaccine_lotno',
        ],
        [
            'label' => 'จำนวนวันจากวันเกิด',
            'attribute' => 'd',
        ],
        [
            'label' => 'ที่มา',
            'attribute' => 'source',
        ],
    ],
]);
?>
