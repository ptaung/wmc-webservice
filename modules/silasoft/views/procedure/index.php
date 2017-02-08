<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wmc Procedures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wmc-procedure-index">
    <p>
        <?= Html::a('Create Wmc Procedure', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'layout' => '<div class="box box-success">
<div class="box-header with-border">
<i class="fa fa-fw fa-television " style="color: #1E8000;"></i> <b>' . $this->title . '</b>
<div class="box-tools pull-right">{summary}</div>
</div>
<div class="box-body">{items}{pager}</div>
</div>',
        'export' => FALSE,
        'pjax' => TRUE,
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'PROCEDURE',
                'attribute' => 'wmc_procedure_name',
            ],
            [
                'label' => 'คำอธิบาย',
                'attribute' => 'wmc_procedure_comment',
            ],
            [
                'label' => 'SEQ',
                'attribute' => 'wmc_procedure_seq',
            ],
            [
                'label' => 'START',
                'attribute' => 'wmc_procedure_startprocess',
            ],
            [
                'label' => 'FINISH',
                'attribute' => 'wmc_procedure_finishprocess',
            ],
            [
                'label' => 'USETIME',
                'attribute' => 'hbs_sync_start',
                'format' => 'raw',
                'value' => function($data) {
                    $date1 = new DateTime($data['wmc_procedure_startprocess']);
                    $date2 = new DateTime($data['wmc_procedure_finishprocess']);
                    $diff = $date2->diff($date1);
                    #return $diff->format('%a Day and %h hours');
                    return $diff->format('%i.%s');
                    ;
                }
            ],
            [
                'label' => 'MESSAGE',
                'attribute' => 'wmc_procedure_message',
                'format' => 'raw',
                'value' => function($data) {
                    return ($data['wmc_procedure_message'] <> '' ? "<span class='text-danger'>{$data['wmc_procedure_message']}</span>" : '');
                }
            ],
            [
                'label' => 'STATUS',
                'attribute' => 'wmc_procedure_status',
            ],
        #['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
