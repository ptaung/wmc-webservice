<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\components\Cwidget;
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
$menu = Cwidget::getMenuDetail($_GET['items']);
$this->title = $menu->menu_items_name;
$this->params['breadcrumbs'][] = ['label' => $menu->menuGroup->menu_group_name, 'url' => ['/report/default/menu', 'id' => $menu->menu_group_id]];
$this->params['breadcrumbs'][] = $this->title;

/*
  foreach ($dataProvider->allModels as $key => $rows) {
  $cat[] = $rows['hosname'];
  $data[] = (doubleval($rows['cc_all']));
  $data2[] = (doubleval($rows['cc_false_mod11']));
  }
  $series[] = ['name' => 'ประชากร', 'data' => $data];
  $series[] = ['name' => 'CID ไม่ถูกต้อง', 'data' => $data2];
 *
 */
?>

<div class="rep-index">

    <div class="alert alert-dismissible alert-success">
        <h4><strong>ชื่อเรื่อง ||</strong> <?= $menu->menu_items_name; ?></h4>
        <p><small>คำอธิบาย || <?= $menu->menu_items_comment; ?></small></p>
    </div>

    <?php
    #echo Cwidget::widget($filterOption) . Html::button('View SQL-Query', ['class' => 'btn btn-info btn-xs']);
    ?>
    <?php
    /*
      echo Highcharts::widget([
      'options' => [
      'chart' => [
      'height' => 250,
      'type' => 'column'
      ],
      'title' => [
      'text' => ' '
      ],
      'xAxis' => [
      'categories' => $cat//['Apples', 'Bananas', 'Oranges']
      ],
      'yAxis' => [
      'title' => ['text' => 'Fruit eaten']
      ],
      'series' => $series
      ]
      ]);
     *
     */
    ?>

    <?php Pjax::begin(['id' => 'gridReportPjax', 'enablePushState' => false]) ?>
    <?=
    @GridView::widget([
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> แสดงผลรายงาน</h3>',
            'type' => 'default',
            'before' => '<div class="btn-group" role="group" aria-label="">'
            . Cwidget::widget($filterOption)
            . Html::button(Icon::show('code', ['class' => 'octicon'], Icon::OCT) . ' SQL', ['class' => 'btn btn-info btn-sm'])
            . Html::a(Icon::show('code', ['class' => 'octicon'], Icon::OCT) . ' แก้ไข', ['/report/menuitems/update', 'id' => $menu->menu_items_id], ['class' => 'btn btn-default btn-sm']) . '</div>',
//'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
            #'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer' => false
        ],
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
</div>

