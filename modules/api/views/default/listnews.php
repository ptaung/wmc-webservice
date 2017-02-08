<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <?=
    GridView::widget([
        'export' => false,
        'floatHeader' => true,
        'panel' => [
            //'before' => '',
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-envelope"></i> ข่าวประชาสัมพันธ์</h3>',
            'type' => 'primary',
        #'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        #'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        #'footer' => false
        ],
        'floatHeader' => true,
        #'floatHeaderOptions' => ['scrollingTop' => '50'],
        'pjax' => true,
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'label' => 'ข่าวประชาสัมพันธ์',
                'attribute' => 'news_header',
                'format' => 'raw',
                'value' => function($data) {
                    return '<span class="badge">' . $data['news_count'] . '</span> ' . Html::a($data['news_header'], ['show', 'id' => $data['news_id']]);
                },
                        'headerOptions' => ['width' => '80%'],
                    //'contentOptions' => ['class' => 'text-center'],
                    ],
                    'news_date:date',
                    'news_count:integer',
                ],
                'toggleDataContainer' => ['class' => 'btn-group-xs'],
                'exportContainer' => ['class' => 'btn-group-xs']
            ]);
            ?>

</div>
