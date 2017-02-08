<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\webclient\components\Cwebclient;

$this->title = 'สรุปการประมวลคุณภาพข้อมูลจาก Hosxp';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-group-index">
    <?php
    if (!\Yii::$app->user->can('super_admin')) {
        $sqlStringAdd = " and hoscode='{$dataselect}' ";
    }
    ?>

    <div class="">
        <?=
        GridView::widget([
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> ' . $this->title . '</h3>',
                'type' => 'default',
            ],
            'export' => [
                'label' => 'ส่งออกรายงาน',
            ],
            'exportConfig' => [
                GridView::EXCEL => ['label' => 'บันทึกเป็น EXCEL'],
            #GridView::PDF => ['label' => 'บันทึกเป็น PDF'],
            ],
            'pjax' => true,
            'responsiveWrap' => false,
            #'floatHeader' => true,
            #'export' => false,
            'dataProvider' => $dataProvider,
                /*
                  'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                  [
                  'label' => 'รายการที่ตรวจสอบ',
                  'attribute' => 'wmc_xalert_title',
                  'format' => 'raw',
                  ],
                  [
                  'label' => 'จำนวนข้อผิดพลาด',
                  'attribute' => 'error',
                  'format' => ['decimal', 0],
                  ],
                  [
                  'label' => 'ตรวจสอบ',
                  'attribute' => 'eid',
                  ],
                  ],
                 *
                 */
        ]);
        ?>
        <?php #yii\widgets\Pjax::end()       ?>
    </div>
</div>
