<?php

use yii\helpers\Html;
#use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ph Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ph-request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ph Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'panel' => [
            //'before' => '',
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-envelope"></i> คำของบประมาณ</h3>',
            'type' => 'primary',
        #'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        #'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        #'footer' => false
        ],
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'floatHeader' => true,
        'toggleDataContainer' => ['class' => 'btn-group-xs'],
        'exportContainer' => ['class' => 'btn-group-xs'],
        'tableOptions' => ['class' => 'table table-striped table-hover tabs-stacked'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'budget.budget_name',
            [
                'label' => 'ประเภท งปม.',
                'attribute' => 'budgetType.budget_type_name',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:260px;'],
                'header' => 'Actions',
                'template' => '{view}',
                'buttons' => [
                    //view button
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-th-list"></span> จัดการ', $url, [
                                    'title' => Yii::t('app', 'จัดการ'),
                                    'class' => 'btn btn-primary btn-xs',
                        ]);
                    },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url = '/jobs/view?id='; // . $model->jobid;
                        return $url;
                    }
                }
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>

</div>
