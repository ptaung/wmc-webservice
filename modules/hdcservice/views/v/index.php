<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\modules\hdcservice\components\Cwidget;
use app\modules\hdcservice\components\Report;
use kartik\icons\Icon;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;

Icon::map($this);
Icon::map($this, Icon::OCT);
$script = <<<SKRIPT

//$(document).on('submit', 'form[data-pjax]', function(event) {
  //$.pjax.submit(event, '#gridReportPjax')
//})
$(document).on('ready pjax:success', function() {
    $('#fa-spin').removeClass('fa-spin');
});
SKRIPT;

$this->registerJs($script);
?>
<?php
$menu = Report::getMenuDetail($_GET['items']);
$this->title = $menu->menu_items_name;
$this->params['breadcrumbs'][] = ['label' => $menu->menuGroup->menu_group_name, 'url' => ['/report/default/menu', 'id' => $menu->menu_group_id]];
$this->params['breadcrumbs'][] = $this->title;



foreach ((array) $dataProvider->allModels as $key => $rows) {
    $cat[] = $rows['areacode'];
    $data[] = ['name' => $rows['arealabel'], 'y' => (float) number_format($rows['percent'], 2)];
}
$series[] = ['name' => 'ประชากร', 'data' => $data];

$dataseries = json_encode($data);
?>

<div class="rep-index">

    <div class="alert alert-dismissible alert-success">
        <h4><strong>ชื่อเรื่อง ||</strong> <?= $menu->sysreport->report_name; ?></h4>
        <!--
        <p><small>หมายเหตุ || <?= ($menu->sysreport->notice <> '' ? $menu->sysreport->notice : 'ไม่มี'); ?></small></p>
        -->
    </div>
    <div class="alert alert-dismissible alert-success">
        <?php
        #echo Cwidget::widget($filterOption) . Html::button('View SQL-Query', ['class' => 'btn btn-info btn-xs']);
        echo Cwidget::widget($filterOption);
        ?>
    </div>
    <?php
    /*
      Highcharts::widget([
      #'scripts' => [
      #'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
      #'modules/exporting', // adds Exporting button/menu to chart
      #'modules/exporting.th',
      //'themes/grid'        // applies global 'grid' theme to all charts
      #],
      'options' => [
      'chart' => [
      'height' => 250,
      'type' => 'column',
      'zoomType' => 'xy',
      ],
      'title' => [
      'text' => ' '
      ],
      'xAxis' => [
      'categories' => $cat,
      ],
      'yAxis' => [
      'min' => 0,
      'showEmpty' => true,
      'title' => ['text' => 'อัตรา(100)'],
      'plotLines' => [
      #'value' => 1000,
      #'color' => 'red',
      #'dashStyle' => 'shortdash',
      #'width' => 8,
      #'zIndex' => 4,
      ],
      ],
      'credits' => [
      'enabled' => false
      ],
      'series' => $series
      ]
      ]);
     *
     */
    ?>
    <?php
    Highcharts::widget([
        'scripts' => [
            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
            'modules/exporting', // adds Exporting button/menu to chart
            //'themes/grid',       // applies global 'grid' theme to all charts
            'highcharts-3d',
        //'modules/drilldown'
        #'modules/exporting.th',
        ]
    ]);
    ?>
    <?php
    $this->registerJs("$(function () {
                    Highcharts.setOptions({
                        lang: {
                            decimalPoint: '.',
                            thousandsSep: ','
                        }
                    });

                    $('#container').highcharts({
                        credits:{
                            enabled: false
                        },
                        chart: {
                            type: 'column'
                        },
                        colors: ['#7cb5ec', '#1d599d', '#90ed7d', '#f7a35c', '#8085e9',
                            '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'],
                        title: {
                            text: '{$menu->sysreport->report_name}'
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            min: 0,
                            //max: 100,
                            showEmpty: true,
                            title: {
                                text: 'จำนวน',
                            }
                            ,plotLines: [{
                                value: " . ($menu->sysreport->target <> '' ? $menu->sysreport->target : 0) . ",
                                color: '#F00A78',
                                dashStyle :'ShortDash',
                                width: 2,
                                zIndex:999,
                                label: {
                                        text: 'เป้าหมาย',
                                        align: 'center',
                                        style: {
                                                color: 'black'
                                        }
                                }
                            }],
                        },

                        legend: {
                            enabled: false
                        },

                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },

                        series: [
                            {
                                name:'จำนวน',
                                colorByPoint: true,
                                data:$dataseries

                            }
                        ]
                    });
                });", yii\web\View::POS_END);
    ?>
    <?php Pjax::begin(['id' => 'gridReportPjax', 'enablePushState' => false]) ?>

    <div class="alert alert-dismissible alert-success hidden">
        <p><?= ($menu->sysreport->aname <> '' ? 'A หมายถึง ' . $menu->sysreport->aname : 'ไม่มี'); ?></p>
        <p><?= ($menu->sysreport->bname <> '' ? 'B หมายถึง ' . $menu->sysreport->bname : 'ไม่มี'); ?></p>
    </div>

    <?=
    GridView::widget([
        'caption' => $menu->sysreport->report_name,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> แสดงผลรายงาน</h3>',
            'type' => 'default',
            'before' => '    <div id="container"></div>
' .
            "<p>" . ($menu->sysreport->aname <> '' ? 'A หมายถึง ' . $menu->sysreport->aname : 'ไม่มี') . "</p>
            <p>" . ($menu->sysreport->bname <> '' ? 'B หมายถึง ' . $menu->sysreport->bname : 'ไม่มี') . "</p>" .
            '<div class="btn-group" role="group" aria-label="">'
            #. Html::button(Icon::show('code', ['class' => 'octicon'], Icon::OCT) . ' SQL', ['class' => 'btn btn-info btn-sm'])
            #. Html::a(Icon::show('code', ['class' => 'octicon'], Icon::OCT) . ' แก้ไข', ['/report/menuitems/update', 'id' => $menu->menu_items_id], ['class' => 'btn btn-default btn-sm'])
            . '</div>',
//'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
            #'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer' => false
        ],
        'resizableColumns' => true,
        #'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        #'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'export' => [
            'label' => 'ส่งออกรายงาน',
        ],
        'exportConfig' => [
            GridView::EXCEL => ['label' => 'บันทึกเป็น EXCEL'],
        #GridView::PDF => ['label' => 'บันทึกเป็น PDF'],
        ],
        'beforeHeader' => $beforeHeader,
        'layout' => "{sorter}\n{pager}\n{summary}\n{items}",
        'floatHeader' => true,
        'responsive' => true,
        'bootstrap' => true,
        'hover' => true,
        'responsiveWrap' => false,
        'pjax' => true,
        'pjaxSettings' => [
            'neverTimeout' => true,
            'options' => [
                'id' => 'w0',
            ]
        ],
        'dataProvider' => $dataProvider,
        'columns' => $columns,
        'toggleDataContainer' => ['class' => 'btn-group-sm'],
        'exportContainer' => ['class' => 'btn-group-sm'],
        'showPageSummary' => true,
    ]);
    ?>
    <?php Pjax::end() ?>

    <div class="alert">
        <p><?= ($menu->sysreport->aname <> '' ? 'หมายเหตุ :: ' . $menu->sysreport->aname : 'ไม่มี'); ?></p>
        <p>วันที่ประมวลผล ::<?= date('Y-m-d') ?></p>
    </div>
</div>

