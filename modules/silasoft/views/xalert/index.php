<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Wmc Xalerts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wmc-xalert-index">
    <p>
        <?= Html::a('Create Wmc Xalert', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
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
            'wmc_xalert_id',
            'wmc_xalert_active',
            'wmc_xalert_title',
            #'wmc_xalert_query:ntext',
            'wmc_xalert_status',
        // 'wmc_xalert_orderby',
        // 'wmc_xalert_querytype',
        // 'wmc_xalert_start',
        // 'wmc_xalert_finish',
        // 'wmc_xalert_message',
        // 'wmc_xalert_name',
        # ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
