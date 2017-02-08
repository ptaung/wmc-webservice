<?php

use yii\helpers\Html;
#use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'หน่วยงานส่งคำขอ';
$this->params['breadcrumbs'][] = "บันทึกคำของบประมาณ";
$this->params['breadcrumbs'][] = $this->title;
#echo \Yii::$app->user->can('admin', 'author');
?>
<?php
$this->registerJs(
        '
$(".activity-view-link").click(function(e) {
            //var fID = $(this).closest("tr").data("key");
            var url = $(this).attr("href");
            $.get(
                url,
                {
                    //id: fID
                },
                function (data)
                {
                    //$("#activity-modal").modal("toggle").css({"width": "1200"});
                    $("#activity-modal").find(".modal-body").html("ไม่พบข้อมูล");
                    $("#activity-modal").find(".modal-body").html(data);
                    $(".modal-body").html("ไม่พบข้อมูล");
                    $(".modal-body").html(data);
                    $("#activity-modal").modal("show");
                    //$.pjax.reload({container:"#kv-unique-id-993"});
                }
            );
        });

');
?>
<div class="ph-order-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('+เพิ่มรายการ', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('+ส่งรายการคำขอ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([

        'panel' => [
            //'before' => '',
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-envelope"></i> รายการที่หน่วยงานส่งคำขอ</h3>',
            'type' => 'primary',
        #'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        #'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        #'footer' => false
        ],
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'pjax' => true,
        'pjaxSettings' => [
            'enablePushState' => false,
            'neverTimeout' => true,
            'options' => ['id' => 'kv-unique-id-991'],
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => true,
        'floatHeaderOptions' => ['scrollingTop' => '10'],
        'toggleDataContainer' => ['class' => 'btn-group-xs'],
        'exportContainer' => ['class' => 'btn-group-xs'],
        'showPageSummary' => true,
        'pageSummaryRowOptions' => ['class' => 'kv-page-summary default'],
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'columns' => [
            #['class' => 'kartik\grid\CheckboxColumn'],
            #['class' => 'kartik\grid\SerialColumn'],
            [
                'label' => '#',
                'format' => 'raw',
                'vAlign' => 'middle',
                'headerOptions' => ['width' => '1%'],
                'value' => function($model) {
            //return '<span class="btn btn-primary btn-sm">ส่งรายการคำขอ</span>';
            return Html::a('<span class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-tasks"></span> ส่งรายการคำขอ</span>', ['operationreq/req', 'id' => $model->request_id, 'order_id' => $model->order_id], [
                        'class' => 'activity-view-link',
                        'title' => Yii::t('yii', 'ปรับสถานะ'),
                        'data-toggle' => 'modal',
                        'data-target' => '#request-modal',
                        //'data-id' => $model->request_id,
                        'data-pjax' => '0',
            ]);
        },
            ],
            [
                'label' => '#',
                'format' => 'raw',
                'vAlign' => 'middle',
                'headerOptions' => ['width' => '1%'],
                'value' => function($model) {
            //return '<span class="btn btn-success btn-sm">ปรับสถานะ</span>';
            return Html::a('<span class="btn btn-success btn-sm"><span class="glyphicon glyphicon-tasks"></span> ปรับสถานะ</span>', ['operationorder/create', 'id' => $model->request_id, 'order_id' => $model->order_id], [
                        'class' => 'activity-view-link',
                        'title' => Yii::t('yii', 'ปรับสถานะ'),
                        'data-toggle' => 'modal',
                        'data-target' => '#request-modal',
                        //'data-id' => $model->request_id,
                        'data-pjax' => '0',
            ]);
        },
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'order_priority',
                'readonly' => function($model, $key, $index, $widget) {
                    return (!$model->order_active); // do not allow editing of inactive records
                },
                'editableOptions' => [
                    //'header' => 'order_priority',
                    'editableValueOptions' => ['class' => 'text-success h3'],
                    'pluginEvents' => [
                        'editableSubmit' => 'function(event, val, form, data) { $.pjax.reload({container:"#kv-unique-id-991"}); }',
                    ], 'format' => Editable::INPUT_TEXT,
                    'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                    'options' => [
                        'pluginOptions' => ['min' => 1, 'max' => 20],
                    ],
                ],
                'hAlign' => 'right',
                'vAlign' => 'middle',
                'width' => '100px',
            //'format' => ['decimal', 2],
            //'pageSummary' => true
            ],
            [
                'attribute' => 'hosp.hospcode_name',
                'format' => 'raw',
                'vAlign' => 'middle',
            #'group' => true,
            #'mergeHeader' => true,
            #'groupedRow' => true,
            ],
            [
                'label' => 'งบประมาณ',
                'attribute' => 'request_id',
                'vAlign' => 'middle',
                'value' => function ($model) {
                    return $model->request->fullname;
                },
                'group' => true,
                'groupedRow' => true,
            ],
            [
                'attribute' => 'items.items_name',
                'vAlign' => 'middle',
            ],
            [
                'label' => 'จำนวนเงิน(บาท)',
                'attribute' => 'items.items_cost',
                'format' => ['decimal', 2],
                'hAlign' => 'right',
                'pageSummary' => true,
                'vAlign' => 'middle',
            ],
            [
                'attribute' => 'order_amount',
                'format' => ['integer'],
                'hAlign' => 'right',
                'pageSummary' => true,
                'vAlign' => 'middle',
            ],
            [
                'attribute' => 'reason.fullname',
                'vAlign' => 'middle',
            ],
            [

                'attribute' => 'order_reason',
                'vAlign' => 'middle',
                'value' => function($model) {
                    return ($model->order_reason ? $model->order_reason : '');
                },
            ],
            [
                'attribute' => 'order_date',
                'vAlign' => 'middle',
                'format' => 'datetime',
            ],
            [
                'label' => 'แก้ไขล่าสุด',
                'attribute' => 'order_date_modify',
                'vAlign' => 'middle',
                'format' => 'datetime',
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                //'contentOptions' => ['style' => 'width:260px;'],
                'hAlign' => 'left',
                'header' => 'ไฟล์แนบ',
                'template' => '{fproject}{fcost}{fspec}{fbreakeven}{fetc}',
                'buttons' => [
                    //view button
                    'fproject' => function ($url, $model) {
                        $f = Yii::$app->urlManager->baseUrl . '/' . $model->order_file_project;
                        if (file_exists($f) || !empty($model->order_file_project)) {
                            $show = TRUE;
                        } else {
                            $show = FALSE;
                        }
                        return Html::a(($show ? '<span class="glyphicon glyphicon-paperclip"></span>' : '') . ' ไฟล์โครงการ', ($show ? $f : 'javascript:;'), ['class' => 'btn btn-' . ($show ? 'success' : 'warning') . ' btn-xs', 'target' => '_blank',]);
                    },
                            'fcost' => function ($url, $model) {
                        $f = Yii::$app->urlManager->baseUrl . '/' . $model->order_file_cost;
                        if (file_exists($f) || !empty($model->order_file_cost)) {
                            $show = TRUE;
                        } else {
                            $show = FALSE;
                        }
                        return Html::a(($show ? '<span class="glyphicon glyphicon-paperclip"></span>' : '') . ' ไฟล์สืบราคา', ($show ? $f : 'javascript:;'), ['class' => 'btn btn-' . ($show ? 'success' : 'warning') . ' btn-xs', 'target' => '_blank',]);
                    },
                            'fspec' => function ($url, $model) {
                        $f = Yii::$app->urlManager->baseUrl . '/' . $model->order_file_spec;
                        if (file_exists($f) || !empty($model->order_file_spec)) {
                            $show = TRUE;
                        } else {
                            $show = FALSE;
                        }
                        return Html::a(($show ? '<span class="glyphicon glyphicon-paperclip"></span>' : '') . ' ไฟล์สเปก', ($show ? $f : 'javascript:;'), [ 'class' => 'btn btn-' . ($show ? 'success' : 'warning') . ' btn-xs', 'target' => '_blank',]);
                    },
                            'fbreakeven' => function ($url, $model) {
                        $f = Yii::$app->urlManager->baseUrl . '/' . $model->order_file_breakeven;
                        if (file_exists($f) || !empty($model->order_file_breakeven)) {
                            $show = TRUE;
                        } else {
                            $show = FALSE;
                        }
                        return Html::a(($show ? '<span class="glyphicon glyphicon-paperclip"></span>' : '') . ' ไฟล์คุ้มทุน', ($show ? $f : 'javascript:;'), ['class' => 'btn btn-' . ($show ? 'success' : 'warning') . ' btn-xs', 'target' => '_blank',]);
                    },
                            'fetc' => function ($url, $model) {
                        $f = Yii::$app->urlManager->baseUrl . '/' . $model->order_file_etc;
                        if (file_exists($f) || !empty($model->order_file_etc)) {
                            $show = TRUE;
                        } else {
                            $show = FALSE;
                        }
                        return ($show ? Html::a('<span class="glyphicon glyphicon-paperclip"></span> ไฟล์อื่นๆ', ($show ? $f : 'javascript:;'), ['class' => 'btn btn-success btn-xs', 'target' => '_blank',]) : '');
                    },
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'template' => '{update}{delete}',
                        'hAlign' => 'left',
                        'buttons' => [
                            'update' =>
                            function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span> แก้ไข', $url, ['class' => 'btn btn-warning btn-xs']);
                            },
                                    'delete' =>
                                    function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span> ลบ', $url, ['class' => 'btn btn-danger btn-xs',
                                            'data-pjax' => 'w0',
                                            'data-confirm' => Yii::t('app', 'ยื่นยันการลบข้อมูลนี้หรือไม่?'),
                                            'data-method' => 'post',
                                ]);
                            }
                                ],
                            ],
                        ],
                    ]);
                    ?>
                    <?php
                    Modal::begin([
                        'id' => 'activity-modal',
                        'size' => 'modal-lg',
                        'header' => '<h4 class="modal-title">ปรับขึ้นตอนการดำเนินงาน</h4>',
                        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
                    ]);
                    ?>

                    <?php Modal::end(); ?>
</div>
