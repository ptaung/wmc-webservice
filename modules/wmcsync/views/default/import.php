<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\webclient\components\Cwebclient;
use app\components\TeerapatFunction;

$this->title = 'IMPORT';
$this->params['breadcrumbs'][] = $this->title;
?>
<?=

GridView::widget([
    #'id' => 'gWmcsync',
    #'pjax' => true,
    'responsiveWrap' => false,
    #'floatHeader' => true,
    'export' => false,
    /*
      'layout' => '<div class="box box-danger">
      <div class="box-header with-border">
      <i class="fa fa-fw fa-television " style="color: #1E8000;"></i> <b>' . $this->title . ' (' . date('H:i:s') . ')</b>
      <div class="box-tools pull-right">{summary}</div>
      </div>
      <div class="box-body">{items}{pager}</div>
      </div>',
     *
     */
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'STATUS',
            'attribute' => 'groupdata',
            'format' => 'raw',
            'value' => function($data) {
                return '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
            }
        ],
        [
            'label' => 'TABLE-NAME',
            'attribute' => 'groupdata',
        ],
        [
            'label' => 'IMPORT-TIME',
            'attribute' => 'starttime',
        ],
        [
            'label' => 'NUMBER-FILES',
            'attribute' => 'countfiles',
        ],
    ],
]);
?>