<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\icons\Icon;
use app\components\Cwidget;
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
<?php Pjax::begin(['id' => 'gridReportPjax', 'enablePushState' => false]) ?>

<?php
$menu = $rptDetail; //Report::getMenuDetail($_GET['items']);
$this->title = @$menu['menu_items_name'];
//$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/webclient/default/menu', 'id' => $menu->menu_group_id]];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="rep-index">
    <div class="alert alert-dismissible alert-success">
        <h4><strong>ชื่อเรื่อง ||</strong> <?= @$menu['menu_items_name']; ?></h4>
        <p><small>คำอธิบาย || <?= @$menu['menu_items_comment']; ?></small></p>
    </div>
    <div>
        <?php
        if (isset($chart['series'])) {
            echo Highcharts::widget([
                'scripts' => [
                    'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                    'modules/exporting', // adds Exporting button/menu to chart
                    #'themes/grid', // applies global 'grid' theme to all charts
                    'highcharts-3d',
                //'modules/drilldown'
                #'modules/exporting.th',
                ],
                'options' => [
                    'chart' => [
                        'type' => (empty($chart['type']) ? 'column' : $chart['type'])#column line spline area pie
                    ],
                    'title' => ['text' => $menu['menu_items_name']],
                    'xAxis' => [
                        //'categories' => $cat
                        'type' => 'category'
                    ],
                    'yAxis' => [
                        'title' => ['text' => 'จำนวน']
                    ],
                    'series' => @$chart['series']
                ]
            ]);
        }
        ?>
    </div>
    <div class="">
        <?=
        GridView::widget([
            'caption' => $menu['menu_items_name'],
            'id' => 'GridView_report',
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> แสดงผลรายงาน</h3>',
                #'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> ' . $menu['menu_items_name'] . '</h3>',
                'type' => 'default',
                'before' => '<div class="btn-group" role="group" aria-label="">'
                . (@strlen($_GET['link']) != 5 ? Cwidget::widget($filterOption) : '')
                #. Html::button(Icon::show('code', ['class' => 'octicon'], Icon::OCT) . ' SQL', ['class' => 'btn btn-info btn-sm'])
                #. Html::a(Icon::show('code', ['class' => 'octicon'], Icon::OCT) . ' แก้ไข', ['/webclient/menuitems/update', 'id' => $menu->menu_items_id], ['class' => 'btn btn-default btn-sm'])
                . '</div>',
            #'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
            #'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            # 'footer' => (@strlen($_GET['link']) == 5 ? true : false),
            ],
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
            'export' => [
                'label' => 'ส่งออกรายงาน',
            ],
            'toolbar' => [
                [
                    '{toggleData}',
                    'options' => ['class' => 'btn-group btn-group-sm'],
                ],
                '{export} {toggleData}',
            ],
            'exportConfig' => [
                GridView::EXCEL => ['label' => 'บันทึกเป็น EXCEL'],
            #GridView::PDF => ['label' => 'บันทึกเป็น PDF'],
            ],
            'beforeHeader' => $beforeHeader,
            #'layout' => "{sorter}\n{pager}\n{summary}\n{items}",
            'floatHeader' => true,
            'responsive' => true,
            'hover' => true,
            'responsiveWrap' => false,
            'pjax' => true,
            'dataProvider' => $dataProvider,
            'columns' => $columns,
            #'toggleDataContainer' => ['class' => 'btn-group-sm'],
            #'exportContainer' => ['class' => 'btn-group-sm'],
            'showPageSummary' => true,
                #'pageSummaryRowOptions' => ['class' => 'default primary'],
        ]);
        ?>
        <?php Pjax::end() ?>
    </div>

</div>