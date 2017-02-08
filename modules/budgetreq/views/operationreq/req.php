<?php

use yii\helpers\Html;
#use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use app\modules\budgetreq\models\PhOperationOrder;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บันทึกคำของบประมาณ';
$this->params['breadcrumbs'][] = 'คำของบประมาณ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ph-operation-request-index">
    <p>
    <div class="pull-left">

    </div>
    <div class="pull-right">

    </div>
    <div class="clearfix"></div>
</p>

<?php
echo GridView::widget([
    'id' => 'req',
    'panel' => [
//'before' => '',
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-envelope"></i> งบประมาณ</h3>',
        'type' => 'primary',
        #'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
#'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        'footer' => false
    ],
    'toolbar' => [
        'export' => false,
    ],
    'dataProvider' => $dataProvider,
    'pjax' => true,
    'pjaxSettings' => [
        //'neverTimeout' => true,
        'options' => ['id' => 'kv-unique-id-99'],
    #'beforeGrid' => 'My fancy content before.',
    #'afterGrid' => 'My fancy content after.',
    ],
    #'floatHeader' => true,
    //'floatHeaderOptions' => ['scrollingTop' => '50'],
    'toggleDataContainer' => ['class' => 'btn-group-xs'],
    'exportContainer' => ['class' => 'btn-group-xs'],
    'tableOptions' => ['class' => 'small'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'งบประมาณ',
            'attribute' => 'request.fullname',
        # 'mergeHeader' => true,
        # 'group' => true,
        ],
        [
            'attribute' => 'operation.operation_name',
        ],
        [
            'attribute' => 'request_center_detail',
            'visible' => 0,
        ],
        [
            'attribute' => 'request_local_detail',
            'visible' => 0,
        ],
        [
            'label' => 'วันที่',
            'format' => 'datetime',
            #'attribute' => 'oporder.operation_order_date',
            'value' => function($model, $key, $index, $column) use ($order_id) {
                $data = PhOperationOrder::customDataOper($model->operation_request_id, $order_id);
                return $data['operation_order_date'];
            }
        ],
        [
            'label' => 'เลขที่หนังสือ',
            #'attribute' => 'oporder.operation_order_number',
            'value' => function($model, $key, $index, $column) use ($order_id) {
                $data = PhOperationOrder::customDataOper($model->operation_request_id, $order_id);
                return $data['operation_order_number'];
            }
        ], /*
          [
          'class' => 'kartik\grid\EditableColumn',
          'attribute' => 'operation_request_id',
          'editableOptions' => [
          //'header' => 'order_priority',
          'format' => Editable::INPUT_TEXT,
          'inputType' => \kartik\editable\Editable::INPUT_SPIN,
          'options' => [
          'pluginOptions' => ['min' => 1, 'max' => 20]
          ]
          ],
          'hAlign' => 'right',
          'vAlign' => 'middle',
          'width' => '100px',
          ],
         *
         */
        [
            'label' => '#',
            'format' => 'raw',
            'visible' => 0,
            'vAlign' => 'middle',
            'headerOptions' => ['width' => '1%'],
            'value' => function($model) {
        return '<span class="btn btn-primary btn-sm">บันทึก</span>';
    },
        ],
    ],
]);
?>

</div>
