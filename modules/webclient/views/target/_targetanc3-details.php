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
<i class="fa fa-fw fa-list-ul" style="color: #1E8000;"></i> <b>ข้อมูลการรับบริการดูแลหลังคลอด</b>
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
            'label' => 'HOSPCODE',
            'attribute' => 'hospcode',
        ],
        [
            'label' => 'วันที่ให้บริการ',
            'attribute' => 'ppcare',
            'format' => 'raw',
            'value' => function($data) {
                return Cwebclient::getThaiDate($data['ppcare']);
            }
        ],
        [
            'label' => 'จำนวนวันจากวันคลอด',
            'attribute' => 'd',
        ],
        [
            'label' => 'หมายเหตุ',
            'attribute' => 'etc',
            'format' => 'raw',
        ],
    ],
]);
?>
