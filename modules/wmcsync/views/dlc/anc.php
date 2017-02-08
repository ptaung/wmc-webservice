<?php
#use yii\helpers\Html;

use kartik\grid\GridView;
#use app\modules\webclient\components\Cwebclient;
use yii\widgets\Pjax;
#use app\components\TeerapatFunction;
use yii\helpers\Url;
use yii\helpers\Html;

$url = Url::to(['dlc']);
$script = <<<JS
$("document").ready(function(){
    $('#pjaxWmcsync').on('click','.operation-dlc', function() {

              $.post('$url',{ id: $(this).data('id'),dlc: $(this).data('dlc')},function(d){
                    alert(d);
             });
         });
     });
JS;
$this->registerJs($script);
$js = <<<JS
function refresh() {
        $.pjax.reload({container: "#pjaxWmcsync",timeout : false});
         setTimeout(refresh, 10000); // restart the function every 5 seconds
    }
refresh();
JS;
$this->registerJs($js, $this::POS_READY);

$this->title = 'อสม อิเล็กทรอนิกส์ | ข้อมูลหญิงตั้งครรภ์';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-warning hidden">
    <div class="box-header with-border">
        <i class="fa fa-envelope " style="color: #F29829;"></i> <b>ข้อมูลหญิงตั้งครรภ์</b>
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
    'layout' => '<div class="box box-warning">
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
            'label' => '#',
            'attribute' => 'confirmtime',
            'format' => 'raw',
            'hAlign' => 'center',
            'value' => function($data) {
                $status = "<a class='btn btn-info btn-xs' href='" . yii\helpers\Url::to(['/webclient/register/anc', 'q_search' => $data['cid'], 'q_hospcode' => $data['hospcode']]) . "'  data-id='{$data['wtc_id']}'>ข้อมูลเพิ่มเติม</a>";
                return $status;
            }
                ],
                [
                    'label' => '#',
                    'attribute' => 'confirmtime',
                    'format' => 'raw',
                    'hAlign' => 'center',
                    'value' => function($data) {
                        if (empty($data['confirmtime']) || trim($data['confirmtime']) == '0000-00-00 00:00:00') {
                            $status = "<a class='btn btn-warning btn-xs operation-dlc' href='javascript:;' data-dlc='1' data-id='{$data['wtc_id']}'>ยืนยันดำเนินการ</a>";
                        } else {
                            $status = "<a class='btn btn-success btn-xs operation-dlc' href='javascript:;' data-dlc='0' data-id='{$data['wtc_id']}'>ยืนยันแล้ว</a>";
                        }
                        return $status;
                    }
                ],
                [
                    'label' => 'INSERT',
                    'attribute' => 'inserttime',
                    'format' => 'raw',
                    'hAlign' => 'right',
                ],
                [
                    'label' => 'UPDATE',
                    'attribute' => 'updatetime',
                    'format' => 'raw',
                    'hAlign' => 'right',
                ],
                [
                    'label' => 'WTC',
                    'attribute' => 'wtc_id',
                    'format' => 'raw',
                    'hAlign' => 'center',
                ],
                [
                    'label' => 'CONFIRM',
                    'attribute' => 'confirmtime',
                    'format' => 'raw',
                    'hAlign' => 'right',
                /*
                  'value' => function($data) {
                  return Cwebclient::getThaiDate($data['confirmtime'], 'S', true);
                  }
                 *
                 */
                ],
                [
                    'label' => 'STATUS',
                    'attribute' => 'command_status',
                    'hAlign' => 'right',
                    'value' => function($data) {
                        if ($data['command_status'] == 'success') {
                            $ref = "สำเร็จ";
                        } elseif ($data['command_status'] == 'error') {
                            $ref = "เกิดข้อผิดพลาด";
                        } else {
                            $ref = "รอดำเนินการ";
                        }
                        return $ref;
                    }
                ],
                [
                    'label' => 'operation',
                    'attribute' => 'operation',
                    'format' => 'raw',
                    #'hAlign' => 'center',
                    'value' => function($data) {
                        if ($data['table'] == 'person_anc') {
                            if ($data['operation'] == 'INSERT') {
                                $ref = "ลงทะเบียนหญิงตั้งครรภ์";
                            } else {
                                $ref = "UPDATE ข้อมูลการคลอด";
                            }
                        }
                        if ($data['table'] == 'person_anc_other_precare') {
                            if ($data['operation'] == 'INSERT') {
                                $ref = "เพิ่มข้อมูลฝากครรภ์ที่อื่น";
                            }
                        }
                        return $ref;
                    }
                ],
                [
                    'label' => 'CID',
                    'attribute' => 'cid',
                    'format' => 'raw',
                    'hAlign' => 'center',
                ],
                [
                    'label' => 'ชื่อ-สกุล',
                    'attribute' => 'person_name',
                    'format' => 'raw',
                #'hAlign' => 'center',
                ],
                [
                    'label' => 'processtime',
                    'attribute' => 'processtime',
                    'hAlign' => 'right',
                    'format' => 'raw',
                /*
                  'value' => function($data) {
                  return Cwebclient::getThaiDate($data['processtime'], 'S', true);
                  }
                 *
                 */
                ],
                /*
                  [
                  'label' => 'SQL',
                  'attribute' => 'sqlquery',
                  'format' => 'raw',
                  'hAlign' => 'right',
                  ],

                  [
                  'label' => 'PROCESS',
                  'attribute' => 'process',
                  'format' => 'raw',
                  ],
                 * *
                 */
                [
                    'label' => 'PROCESS-MESSAGE',
                    'attribute' => 'command_message',
                    'hAlign' => 'right',
                    'format' => 'raw',
                    'value' => function($data) {
                        return '<span class="text-danger small">' . $data['command_message'] . '</span>';
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
