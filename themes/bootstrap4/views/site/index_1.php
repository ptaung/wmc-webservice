<?php

use kartik\growl\Growl;
use kartik\social\FacebookPlugin;
use app\components\Cmap;
use miloschuman\highcharts\Highcharts;
use app\modules\webclient\components\Cdata;
use kartik\grid\GridView;
use yii\helpers\Html;

echo Growl::widget([
    'type' => Growl::TYPE_GROWL,
    'title' => 'ยินดีต้อนรับเข้าสู่' . Yii::$app->params['systemName'],
    'icon' => 'glyphicon glyphicon-ok-sign',
    'body' => 'You successfully read this important alert message.',
    'showSeparator' => true,
    'delay' => 0,
    'pluginOptions' => [
        'showProgressbar' => false,
        'placement' => [
            'from' => 'bottom',
            'align' => 'right',
        ]
    ]
]);

$items = [
    [
        'title' => 'Sintel',
        'href' => 'http://media.w3.org/2010/05/sintel/trailer.mp4',
        'type' => 'video/mp4',
        'poster' => 'http://media.w3.org/2010/05/sintel/poster.png'
    ],
    [
        'title' => 'LES TWINS - An Industry Ahead',
        'href' => 'http://www.youtube.com/watch?v=tluKExFoJkM',
        'type' => 'text/html',
        'youtube' => 'tluKExFoJkM',
        'poster' => 'http://img.youtube.com/vi/tluKExFoJkM/0.jpg'
    ],
];
/*
  echo dosamigos\gallery\Carousel::widget([
  'items' => $items, 'json' => true,
  'clientEvents' => [
  'onslide' => 'function(index, slide) {
  console.log(slide);
  }'
  ]
  ]);
 *
 */
?>

<div class="site-index">
    <!--

   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <!--
   <ol class="carousel-indicators">
       <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
       <li data-target="#carousel-example-generic" data-slide-to="1"></li>
       <li data-target="#carousel-example-generic" data-slide-to="2"></li>
   </ol>

    <!-- Wrapper for slides -->
    <!--   <div class="carousel-inner" role="listbox">

                      <div class="item active">
                          <img src="http://www.asiwi.com/wp-content/uploads/2015/03/system-data-conversion-min.png" alt="">
                          <div class="carousel-caption">
                              <h1>WMDatacenter 2016</h1>
                              <p class="lead"><?php echo \Yii::$app->params['systemName']; ?></p>
                          </div>
                      </div>
                      <div class="item">
                          <img src="http://moudgilgroup.com/wp-content/uploads/2013/08/datacenter_solution_icon.png" alt="">
                          <div class="carousel-caption">
                              <h1>WMDatacenter 2016</h1>
                              <p class="lead"><?php echo \Yii::$app->params['systemName']; ?></p>
                          </div>
                      </div>
    <!--
    <div class="item active">
        <img src="http://opensis.com/img/dashboard_pc.png"  alt="">
        <div class="carousel-caption">
            <div class="jumbotron">
                <h1>WMDatacenter 2016</h1>
                <p class="lead"><?php echo \Yii::$app->params['systemName']; ?></p>
            </div>
        </div>
    </div>
    <!--
    <div class="item">
        <img src="http://vpsth.com/images/Servers.png" alt="">
        <div class="carousel-caption">
            <h1>WMDatacenter 2016</h1>
            <p class="lead"><?php echo \Yii::$app->params['systemName']; ?></p>
        </div>
    </div>

</div> -->


    <!-- Controls -->
    <!--
           <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
               <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
           </a>
           <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
               <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
           </a>
       </div>
   </div>
    <!--
    <div class="jumbotron navbar-inverse-collapse">
        <h1>WMDatacenter 2016</h1>
        <p class="lead"><?php echo \Yii::$app->params['systemName']; ?></p>
        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>
    -->

    <div class="row">
        <!--
        <div class="col-md-4">
            <div class="thumbnail">
        <?php
        #echo Cmap::widget(['zoom' => 7, 'fillColor' => 'white']);
        ?>
            </div>
        </div>
        -->
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Facebook WM</h3>
                        </div>
                        <div class="panel-body">
                            <?php echo FacebookPlugin::widget(['type' => FacebookPlugin::LIKE_BOX, 'settings' => ['href' => 'http://facebook.com/Wm-Webmanager-146500182180711']]); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Version Hosxp</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo Highcharts::widget([
                                'scripts' => [
                                    'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    #'modules/exporting', // adds Exporting button/menu to chart
                                    #'themes/grid', // applies global 'grid' theme to all charts
                                    'highcharts-3d',
                                //'modules/drilldown'
                                #'modules/exporting.th',
                                ],
                                'options' => [
                                    'chart' => [
                                        'type' => 'pie',
                                        'options3d' => [
                                        #'enabled' => true,
                                        #'alpha' => 45,
                                        #'beta' => 0
                                        ],
                                        #'width' => '100',
                                        'height' => '250'
                                    ],
                                    'plotOptions' => [
                                        'pie' => [
                                            #'allowPointSelect' => true,
                                            #'cursor' => 'pointer',
                                            #'depth' => 20,
                                            #'dataLabels' => [
                                            #'enabled' => true,
                                            #'format' => '{point.name}'
                                            #],
                                            'dataLabels' => [
                                                'enabled' => true,
                                                //'distance' => -50,
                                                'style' => [
                                                    'fontWeight' => 'none',
                                                #'color' => 'white',
                                                #'textShadow' => '0px 1px 2px black'
                                                ]
                                            ],
                                        #'startAngle' => -90,
                                        #'endAngle' => 90,
                                        #'center' => ['50%', '75%']
                                        ]
                                    ],
                                    'title' => ['text' => ''],
                                    'xAxis' => [
                                    #'categories' => ['Apples', 'Bananas', 'Oranges']
                                    ],
                                    'yAxis' => [
                                        'title' => ['text' => 'Fruit eaten']
                                    ],
                                    'credits' => ['enabled' => false],
                                    'series' => Cdata::getHosxpversion()
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">10 อันดับโรค OP ย้อนหลัง 90 วัน</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo Highcharts::widget([
                                'scripts' => [
                                    'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    #'modules/exporting', // adds Exporting button/menu to chart
                                    #'themes/grid', // applies global 'grid' theme to all charts
                                    'highcharts-3d',
                                //'modules/drilldown'
                                #'modules/exporting.th',
                                ],
                                'options' => [
                                    'chart' => [
                                        'type' => 'column',
                                        'height' => '250',
                                        'options3d' => [
                                            'enabled' => true,
                                            'alpha' => 10,
                                            'beta' => 0,
                                            'depth' => 50,
                                            'viewDistance' => 25
                                        ],
                                    ],
                                    'colors' => ['#7cb5ec', '#1d599d', '#90ed7d', '#f7a35c', '#8085e9',
                                        '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'],
                                    'title' => ['text' => ''],
                                    'xAxis' => [
                                        'type' => 'category'
                                    ],
                                    'legend' => [
                                        'enabled' => false
                                    ],
                                    'yAxis' => [
                                        'title' => ['text' => '']
                                    ],
                                    'credits' => ['enabled' => false],
                                    'series' => Cdata::getReporttop10op()
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">10 อันดับโรค PP ย้อนหลัง 90 วัน</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo Highcharts::widget([
                                'scripts' => [
                                    'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    #'modules/exporting', // adds Exporting button/menu to chart
                                    #'themes/grid', // applies global 'grid' theme to all charts
                                    'highcharts-3d',
                                //'modules/drilldown'
                                #'modules/exporting.th',
                                ],
                                'options' => [
                                    'chart' => [
                                        'type' => 'column',
                                        'height' => '250',
                                        'options3d' => [
                                            'enabled' => true,
                                            'alpha' => 10,
                                            'beta' => 0,
                                            'depth' => 50,
                                            'viewDistance' => 25
                                        ],
                                    ],
                                    'colors' => ['#7cb5ec', '#1d599d', '#90ed7d', '#f7a35c', '#8085e9',
                                        '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'],
                                    'title' => ['text' => ''],
                                    'xAxis' => [
                                        'type' => 'category'
                                    ],
                                    'legend' => [
                                        'enabled' => false
                                    ],
                                    'yAxis' => [
                                        'title' => ['text' => '']
                                    ],
                                    'credits' => ['enabled' => false],
                                    'series' => Cdata::getReporttop10pp()
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 hidden">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">สรุปการส่งข้อมูล</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo Highcharts::widget([
                                'options' => [
                                    'chart' => [
                                        'type' => 'column',
                                        'height' => '150'
                                    ],
                                    'title' => ['text' => ''],
                                    'xAxis' => [
                                        'categories' => ['Apples', 'Bananas', 'Oranges']
                                    ],
                                    'yAxis' => [
                                        'title' => ['text' => 'Fruit eaten']
                                    ],
                                    'credits' => ['enabled' => false],
                                    'series' => [
                                        ['name' => 'Jane', 'data' => [1, 0, 4]],
                                        ['name' => 'John', 'data' => [5, 7, 3]]
                                    ]
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">ข่าวประชาสัมพันธ์</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo GridView::widget([
                                #'panel' => [
                                //'before' => '',
                                #'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-envelope"></i> ข่าวประชาสัมพันธ์</h3>',
                                #'type' => 'primary',
                                #'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
                                #'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
                                #'footer' => false
                                #],
                                'floatHeader' => true,
                                #'floatHeaderOptions' => ['scrollingTop' => '50'],
                                'pjax' => true,
                                'dataProvider' => Cdata::getNews(),
                                'bordered' => false,
                                'layout' => "{items}\n{pager}",
                                'columns' => [
                                    ['class' => 'kartik\grid\SerialColumn'],
                                    [
                                        'label' => 'ข่าวประชาสัมพันธ์',
                                        'attribute' => 'news_header',
                                        'format' => 'raw',
                                        'value' => function($data) {
                                            return '<span class="badge">' . $data['news_count'] . '</span> ' . Html::a($data['news_header'], ['/news/default/show', 'id' => $data['news_id']]);
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
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">สรุปบริการ</h3>
                                </div>
                                <div class="panel-body">

                                    <?php
                                    echo Highcharts::widget([
                                        'scripts' => [
                                            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                        #'modules/exporting', // adds Exporting button/menu to chart
                                        #'themes/grid', // applies global 'grid' theme to all charts
                                        #'highcharts-3d',
                                        //'modules/drilldown'
                                        #'modules/exporting.th',
                                        ],
                                        'options' => [
                                            'chart' => [
                                                'type' => 'column',
                                                'height' => '250',
                                                'options3d' => [
                                                    'enabled' => false,
                                                    'alpha' => 30,
                                                    'beta' => 0,
                                                    'depth' => 80,
                                                    'viewDistance' => 25
                                                ],
                                            ],
                                            'colors' => ['#7cb5ec', '#1d599d', '#90ed7d', '#f7a35c', '#8085e9',
                                                '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'],
                                            'title' => ['text' => ''],
                                            'xAxis' => [
                                                'type' => 'category'
                                            ],
                                            'legend' => [
                                                'enabled' => false
                                            ],
                                            'yAxis' => [
                                                'title' => ['text' => 'จำนวนครั้งการให้บริการ']
                                            ],
                                            'credits' => ['enabled' => false],
                                            'series' => Cdata::getReportservice()
                                        ]
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">พิกัดสถานบริการ</h3>
                                </div>
                                <?php
                                echo Cmap::widget(['zoom' => 10, 'fillColor' => '#FFE4B5']);
                                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
