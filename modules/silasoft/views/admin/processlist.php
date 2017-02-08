<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;

$url = Url::to(['/silasoft/admin/killprocess']);
$js = <<<JS
function refresh2() {
        $.pjax.reload({container: "#showprocesslist",timeout : false});
         setTimeout(refresh2, 5000); // restart the function every 5 seconds
    }
refresh2();

$("document").ready(function(){
        $('#showprocesslist').on('click','.operation-kill', function() {
              $.post("{$url}?id="+$(this).data('id'),function(data){
                 alert(data);
             });
         });
});

JS;
$this->registerJs($js, $this::POS_READY);

$this->title = 'SQL Show processlist';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wmc-xalert-index">
    <?php Pjax::begin(['id' => 'showprocesslist', 'timeout' => false, 'enablePushState' => false,]) ?>
    <?=
    GridView::widget([
        'layout' => '<div class="box box-success">
<div class="box-header with-border">
<i class="fa fa-fw fa-television " style="color: #1E8000;"></i> <b>' . $this->title . ' (' . date('H:i:s') . ')</b>
<div class="box-tools pull-right">{summary}</div>
</div>
<div class="box-body">{items}{pager}</div>
</div>',
        'export' => FALSE,
        #'pjax' => TRUE,
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => '#',
                #'headerOptions' => [ 'width' => 180],
                'format' => 'raw',
                'contentOptions' => ['style' => 'max-width: 350px; overflow: auto; word-wrap: break-word;'],
                'noWrap' => false,
                'hAlign' => 'center',
                'value' => function($m) {
            $data = '<div class=" btn-group">';
            $data .= Html::a('KILL', 'javascript:;', ['data-id' => $m['ID'], 'class' => "operation-kill btn btn-{$syc_color} btn-xs"]);
            $data .= '</div>';
            return $data;
        }
            ],
            'ID',
            'USER',
            'HOST',
            'DB',
            'COMMAND',
            'TIME',
            'STATE',
            'INFO',
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
