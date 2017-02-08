<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\webclient\components\Cwebclient;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HospitalBaseStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สถานะการเชื่อมต่อ Webservice';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-base-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);     ?>
    <?php yii\widgets\Pjax::begin(['id' => 'nodewebservice']) ?>
    <div class="">
        <?=
        GridView::widget([
            'panel' => [
                //'before' => '',
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th"></i> สถานะการเชื่อมต่อ Webservice</h3>',
                'type' => 'primary',
                'before' => Html::a('สร้างรายการ', ['create'], ['class' => 'btn btn-success']) . ' '
                . Html::a('Refresh', ['index'], ['class' => 'btn btn-success']) . ' '
                . Html::a('SYNC', ['index'], ['class' => 'btn btn-default']) . ' '
                . Html::a('UPDATE', ['index'], ['class' => 'btn btn-default']) . ' '
                . Html::a('ERROR', ['index'], ['class' => 'btn btn-default']) . ' '
            ,
            #'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            #'footer' => false
            ],
            'dataProvider' => $dataProvider,
            'export' => false,
            'floatHeader' => true,
            'responsive' => true,
            'bootstrap' => true,
            'pjax' => true,
            'responsiveWrap' => false,
            'columns' => [
                ['class' => 'kartik\grid\CheckboxColumn', 'headerOptions' => ['class' => 'success'],],
                ['class' => 'kartik\grid\SerialColumn', 'headerOptions' => ['class' => 'success'],],
                [
                    'label' => 'สถานะ',
                    'headerOptions' => ['class' => 'success', 'width' => '200'],
                    'format' => 'raw',
                    'value' => function($m) {
                $data = '<div class=" btn-group">';
                $data .= Html::button('sync', ['class' => 'btn btn-default btn-sm']);

                $data .= Html::button('update', ['class' => 'btn btn-default btn-sm']);
                if ($m['hbs_error']) {
                    $data .= Html::button('error', ['class' => 'btn btn-danger btn-sm']);
                } else {
                    $data .= Html::button('error', ['class' => 'btn btn-default btn-sm']);
                }

                $data .= '</div>';
                return $data;
            }
                ],
                [
                    'label' => 'สถานะ Online',
                    'headerOptions' => ['class' => 'success'],
                    'attribute' => 'online',
                    'group' => true,
                    'groupedRow' => true,
                ],
                [
                    'label' => 'สถานบริการ',
                    'headerOptions' => ['class' => 'success'],
                    'attribute' => 'fullname',
                    'format' => 'raw',
                    'value' => function($m) {
                $data = '<span class="text-info"><b>' . $m['fullname'] . '</b></span></b>';
                $data .= '<br>V. <b>' . $m['hbs_version'] . '</b>';
                $data .= '  IP. <b>' . $m['hbs_ip'] . '</b>';
                return $data;
            }
                ],
                [
                    'label' => 'Online',
                    'attribute' => 'hbs_time',
                    'headerOptions' => ['class' => 'success'],
                    'format' => 'raw',
                    'value' => function($m) {
                if ($m['status_online'] == 1) {
                    $c = 'success';
                } else {
                    $c = 'warning';
                }

                #$data = Cwebclient::getThaiDate($m['hbs_time'], 'S', true) . '</b>';
                $data .= '<span class="btn btn-xs btn-' . $c . '">' . $m['lastonline'] . '</span>';
                return $data;
            }
                ],
                [
                    'label' => 'LastSync',
                    'format' => 'raw',
                    'headerOptions' => ['class' => 'success'],
                    'attribute' => 'usetime',
                    'value' => function($m) {
                if ($m['status_sync'] == 1) {
                    $c = 'success';
                } else {
                    $c = 'warning';
                }
                $data = '<span class="btn btn-xs btn-' . $c . '">' . $m['lastsync'] . '</span>';
                $data .= '<br><span class="small">' . $m['usetime'] . '</span>';

                return $data;
            }
                ],
                [
                    'label' => 'สถานะ',
                    'headerOptions' => ['class' => 'success'],
                    'format' => 'raw',
                    'value' => function($m) {
                if ($m['hbs_status_process'] == 100)
                    $data = Html::button($m['hbs_status_process'] . '%', ['class' => 'btn btn-success btn-xs']);
                else
                    $data = Html::button($m['hbs_status_process'] . '%', ['class' => 'btn btn-danger btn-xs']);

                return $data;
            }
                ],
                [
                    'label' => 'Error report',
                    'headerOptions' => ['class' => 'success'],
                    'attribute' => 'hbs_browser',
                    'format' => 'raw',
                    'value' => function($m) {
                return $data = '<span class="small">' . $m['hbs_browser'] . '</span>';
            }
                ],
            ],
        ]);
        ?>
        <?php yii\widgets\Pjax::end() ?>
    </div>
</div>
