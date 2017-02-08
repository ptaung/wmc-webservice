<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\webclient\components\Cwebclient;
use yii\widgets\Pjax;
use app\components\TeerapatFunction;
use yii\helpers\Url;

$url = Url::to(['import']);
$url_sync = Url::to(['sync']);
$url_dlc = Url::to(['dlc']);
$script = <<<JS
$("document").ready(function(){
    $('#pjaxWmcsync').on('click','.operation-sync', function() {
             $.post('$url_sync',{ id: $(this).data('id'),sync: $(this).data('sync')},function(data){
                //alert(data);
            });
        });

    $('#pjaxWmcsync').on('click','.operation-dlc', function() {
              $.post('$url_dlc',{ id: $(this).data('id'),dlc: $(this).data('dlc')},function(data){
                 //alert(data);
             });
         });
     });
JS;
$this->registerJs($script);

$js = <<<JS
function refresh() {
         $.ajax({ url: "$url", success: function(data) { $("#importprocess").html(data);}})
     setTimeout(refresh, 3000); // restart the function every 5 seconds
    }
refresh();
function refresh2() {
        $.pjax.reload({container: "#pjaxWmcsync",timeout : false});
         setTimeout(refresh2, 10000); // restart the function every 5 seconds
    }
refresh2();
JS;
$this->registerJs($js, $this::POS_READY);



$this->title = 'ระบบติดตามการรับส่งข้อมูล';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-warning">
    <div class="box-header with-border">
        <i class="fa fa-envelope " style="color: #F29829;"></i> <b>ระบบติดตามการนำเข้าข้อมูล</b>
    </div>
    <!-- /.box-header -->
    <div class="box-body" >
        <span id="importprocess"></span>
    </div>
</div>
<?php Pjax::begin(['id' => 'pjaxWmcsync', 'timeout' => false, 'enablePushState' => false,]) ?>
<?=
GridView::widget([
    'id' => 'gWmcsync',
    #'pjax' => true,
    'responsiveWrap' => false,
    #'floatHeader' => true,
    'export' => false,
    'layout' => '<div class="box box-success">
<div class="box-header with-border">
<i class="fa fa-fw fa-television " style="color: #1E8000;"></i> <b>' . $this->title . ' (' . date('H:i:s') . ')</b>
<div class="box-tools pull-right">{summary}</div>
</div>
<div class="box-body">{items}{pager}</div>
</div>',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'STATUS',
            'attribute' => 'pid',
            'format' => 'raw',
            'hAlign' => 'center',
            #'group' => true,
            #'groupedRow' => true,
            'value' => function($data) {
                if ($data['connect'] == 1) {
                    $status = "<span class='label label-success'>&nbsp;ONLINE&nbsp;</span>";
                } else {
                    $status = "<span class='label label-danger'>OFFLINE</span>";
                }
                return $status;
            }
        ],
        [
            'label' => 'NODES',
            'attribute' => 'hbs_hospital_id',
            'format' => 'raw',
            'value' => function($data) {
                if ($data['connect'] == 1) {
                    $status = "18px";
                } else {
                    $status = "14px";
                }
                return "<span style='font-size:{$status};'>"
                        . "<i class='fa fa-fw fa-television'></i> "
                        . "DW-{$data['hbs_hospital_id']}</span><p class='small'>{$data['hbs_version']}</p>";
            }
        ],
        [
            'label' => 'CLIENTS',
            'attribute' => 'hbs_ip',
            'format' => 'raw',
            'value' => function($data) {
                return "<u>IP:{$data['hbs_ip']}</u>" .
                        '<br><small><b>CT:</b> ' . ($data['hbs_time'] <> '0000-00-00 00:00:00' ? Cwebclient::getThaiDate($data['hbs_time'], 'S', true) : '') . '</small>';
            }
        ],
        [
            'label' => 'START/FINISH',
            'attribute' => 'hbs_sync_start',
            'format' => 'raw',
            'value' => function($data) {
                return '<small><b>ST:</b> ' . ($data['hbs_sync_start'] <> '0000-00-00 00:00:00' ? Cwebclient::getThaiDate($data['hbs_sync_start'], 'S', true) : '') . '</small>'
                        . '<br><small><b>FT:</b> ' . ($data['hbs_sync_finish'] <> '0000-00-00 00:00:00' ? Cwebclient::getThaiDate($data['hbs_sync_finish'], 'S', true) : '') . '</small>';
            }
        ],
        [
            'label' => 'UPLOAD',
            'attribute' => 'hbs_upload_size',
            'hAlign' => 'right',
            'value' => function($data) {
                return TeerapatFunction::formatBytes($data['hbs_upload_size']);
            }
        ],
        [
            'label' => 'PROCESS',
            'attribute' => 'hbs_status_process',
            'hAlign' => 'right',
            'format' => 'raw',
            'value' => function($data) {
                return Html::button(number_format(($data['hbs_status_process'] > 0 ? $data['hbs_status_process'] : 0), 2) . '%', ['class' => 'btn btn-default btn-xs']);
            }
                ],
                [
                    'label' => 'PROCESS-STATUS',
                    'attribute' => 'hbs_info',
                    'hAlign' => 'right',
                    'format' => 'raw',
                ],
                [
                    'label' => 'DATA-NODE',
                    'attribute' => 'hbs_datanode',
                    'hAlign' => 'right',
                    'format' => 'raw',
                    'value' => function($data) {
                        return TeerapatFunction::formatBytes($data['hbs_datanode']);
                    }
                ],
                [
                    'label' => 'Operations',
                    #'headerOptions' => [ 'width' => 180],
                    'format' => 'raw',
                    'contentOptions' => ['style' => 'max-width: 350px; overflow: auto; word-wrap: break-word;'],
                    'noWrap' => false,
                    'hAlign' => 'center',
                    'value' => function($m) {
                $data = '<div class=" btn-group">';
                if ($m['hbs_sync'] == 1) {
                    $syc_color = 'success';
                } else {
                    $syc_color = 'default';
                }
                $data .= Html::a('SYNC', 'javascript:;', ['data-id' => $m['hbs_hospital_id'], 'data-sync' => $m['hbs_sync'], 'class' => "operation-sync btn btn-{$syc_color} btn-xs"]);
                if ($m['hbs_command'] == 1) {
                    $syc_color = 'warning';
                } else {
                    $syc_color = 'default';
                }
                $data .= Html::a('DLC', 'javascript:;', ['data-id' => $m['hbs_hospital_id'], 'data-dlc' => $m['hbs_command'], 'class' => "operation-dlc btn btn-{$syc_color} btn-xs"]);

                #$data .= Html::a('up', '', ['class' => 'btn btn-default btn-xs']);

                if ($m['hbs_error'] == 1) {
                    $error_color = 'danger';
                } else {
                    $error_color = 'default';
                }

                $data .= Html::a('ERROR', '', ['class' => "btn btn-{$error_color} btn-xs"]);

                $data .= '</div>';
                return $data;
            }
                ],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
<div class="box box-success container">
    <div class="box-header with-border">
        <b class="font3">SST OFFICIAL <span class="text-green">@SILASOFTTHAILAND</span>
            SERVICE
        </b>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
            <button class="btn btn-box-tool" data-widget="remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

    </div>
</div>
