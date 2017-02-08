<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = "สถานะการ Sync ข้อมูลออนไลน์";
$this->params['breadcrumbs'][] = $this->title;
?>

<?=

GridView::widget([
    'export' => [
        #'fontAwesome' => true,
        'showConfirmAlert' => false,
        'target' => GridView::TARGET_BLANK,
        'label' => 'ส่งออกรายงาน',
    ],
    'exportConfig' => [
        GridView::EXCEL => ['label' => 'บันทึกเป็น EXCEL'],
    #GridView::PDF => ['label' => 'บันทึกเป็น PDF'],
    ],
    #'pjax' => true,
    'responsiveWrap' => false,
    #'floatHeader' => true,
    #'export' => false,
    'layout' => '<div class="box box-success">
<div class="box-header with-border">
<i class="fa fa-fw fa-list-ul" style="color: #1E8000;"></i> <b>สถานะการ Sync ข้อมูลออนไลน์ สำหรับ รพ.สต.</b>
<div class="box-tools pull-right">{summary}</div>
</div>
<div class="box-body">
         {items}{pager}
</div>
</div>',
    'dataProvider' => $dataProvider_pcu,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Sync',
            'attribute' => 'p',
            'format' => 'raw',
            'value' => function($data) {
                $result = '';
                if ($data['p'] == '1') {
                    $result = 'ครบ';
                    $color = 'success';
                } else {
                    $result = '-';
                    $color = 'default';
                }

                return "<button class='btn btn-xs btn-{$color} col-md-12'>" . $data['p'] . "</button>";
            },
        ],
        [
            'label' => 'รหัสหน่วยบริการ',
            'attribute' => 'hospcode',
        ],
        [
            'label' => 'หน่วยบริการ',
            'attribute' => 'hname',
        ],
        [
            'label' => 'hosxp-version',
            'attribute' => 'hosxp_version',
        ],
        [
            'label' => 'Sync',
            'attribute' => 'last_update',
        ],
        [
            'label' => 'ใช้เวลา',
            'attribute' => 'usetime',
            'format' => 'raw',
        ],
        [
            'label' => 'คุณภาพ',
            'attribute' => 'complete_percent',
        ],
        [
            'label' => 'Status',
            'attribute' => 'send_status',
            'format' => 'raw',
        ],
    ],
]);
?>
<?=

GridView::widget([
    'export' => [
        #'fontAwesome' => true,
        'showConfirmAlert' => false,
        'target' => GridView::TARGET_BLANK,
        'label' => 'ส่งออกรายงาน',
    ],
    'exportConfig' => [
        GridView::EXCEL => ['label' => 'บันทึกเป็น EXCEL'],
    #GridView::PDF => ['label' => 'บันทึกเป็น PDF'],
    ],
    #'pjax' => true,
    'responsiveWrap' => false,
    #'floatHeader' => true,
    #'export' => false,
    'layout' => '<div class="box box-success">
<div class="box-header with-border">
<i class="fa fa-fw fa-list-ul" style="color: #1E8000;"></i> <b>สถานะการ Sync ข้อมูลออนไลน์ สำหรับ รพ.</b>
<div class="box-tools pull-right">{summary}</div>
</div>
<div class="box-body">
         {items}{pager}
</div>
</div>',
    'dataProvider' => $dataProvider_hos,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Sync',
            'attribute' => 'p',
            'format' => 'raw',
            'value' => function($data) {
                $result = '';
                if ($data['p'] == '1') {
                    $result = 'ครบ';
                    $color = 'success';
                } else {
                    $result = '-';
                    $color = 'default';
                }

                return "<button class='btn btn-xs btn-{$color} col-md-12'>" . $data['p'] . "</button>";
            },
        ],
        [
            'label' => 'รหัสหน่วยบริการ',
            'attribute' => 'hospcode',
        ],
        [
            'label' => 'หน่วยบริการ',
            'attribute' => 'hname',
        ],
        [
            'label' => 'hosxp-version',
            'attribute' => 'hosxp_version',
        ],
        [
            'label' => 'Sync',
            'attribute' => 'last_update',
        ],
        [
            'label' => 'ใช้เวลา',
            'attribute' => 'usetime',
            'format' => 'raw',
        ],
        [
            'label' => 'คุณภาพ',
            'attribute' => 'complete_percent',
        ],
        [
            'label' => 'Status',
            'attribute' => 'send_status',
            'format' => 'raw',
        ],
    ],
]);
?>
