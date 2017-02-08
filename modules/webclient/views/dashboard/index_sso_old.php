<?php

use kartik\growl\Growl;
#use kartik\social\FacebookPlugin;
use app\components\Cmap;
use miloschuman\highcharts\Highcharts;
use app\modules\webclient\components\Cdata;
use kartik\grid\GridView;
use yii\helpers\Html;

#echo '<pre>';
#$user = Yii::$app->user->identity->profile;
#print_r($user->user);
#echo '</pre>';
echo Growl::widget([
    'type' => Growl::TYPE_GROWL,
    'title' => 'ยินดีต้อนรับเข้าสู่' . Yii::$app->params['systemName'],
    'icon' => 'glyphicon glyphicon-ok-sign',
    'body' => 'สวัสดีค่ะคุณ' . Yii::$app->user->identity->profile->name,
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
?>

<div class="site-index">


    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Version Hosxp</h3>
                        </div>
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
                                'colors' => ['#7cb5ec', '#1d599d', '#90ed7d', '#f7a35c', '#8085e9', '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'],
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
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">10 อันดับโรค OP ย้อนหลัง 60 วัน</h3>
                        </div>
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
                                        'enabled' => false,
                                        'alpha' => 10,
                                        'beta' => 0,
                                        'depth' => 50,
                                        'viewDistance' => 25
                                    ],
                                ],
                                'plotOptions' => [
                                    'column' => [
                                        'stacking' => 'normal',
                                    ]
                                ],
                                'colors' => ['#7cb5ec', '#1d599d', '#90ed7d', '#f7a35c', '#8085e9',
                                    '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'],
                                'title' => ['text' => ''],
                                'xAxis' => [
                                    'type' => 'category'
                                ],
                                'legend' => [
                                    'enabled' => false,
                                    'floating' => true,
                                ],
                                'yAxis' => [
                                    'title' => ['text' => ''],
                                    'stackLabels' => ['enabled' => true],
                                ],
                                'credits' => ['enabled' => false],
                                'series' => Cdata::getReporttop10op()
                            ]
                        ]);
                        ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">10 อันดับโรค PP ย้อนหลัง 60 วัน</h3>
                        </div>
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
                                        'enabled' => false,
                                        'alpha' => 10,
                                        'beta' => 0,
                                        'depth' => 50,
                                        'viewDistance' => 25
                                    ],
                                ],
                                'plotOptions' => [
                                    'column' => [
                                        'stacking' => 'normal',
                                    ]
                                ],
                                'colors' => ['#7cb5ec', '#1d599d', '#90ed7d', '#f7a35c', '#8085e9',
                                    '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'],
                                'title' => ['text' => ''],
                                'xAxis' => [
                                    'type' => 'category'
                                ],
                                'legend' => [
                                    'enabled' => false,
                                    'floating' => true,
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
        </div>

        <div class="col-md-9">
            <div class="row">

                <div class="col-md-12 hidden">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">ข่าวประชาสัมพันธ์</h3>
                        </div>
                        <?php
                        echo GridView::widget([
                            'export' => false,
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

                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">สรุปบริการ</h3>
                                </div>

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
                                            'type' => 'area',
                                            'height' => '250',
                                            'options3d' => [
                                                'enabled' => false,
                                                'alpha' => 30,
                                                'beta' => 0,
                                                'depth' => 80,
                                                'viewDistance' => 25
                                            ],
                                        ],
                                        'colors' => ['#f7a35c', '#91e8e1', '#8085e9', '#1d599d', '#7cb5ec', '#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
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
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">สรุปบริการผู้ป่วยนอกตาม 298 กลุ่มโรค</h3>
                                </div>

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
                                            'type' => 'area',
                                            'height' => '250',
                                            'options3d' => [
                                                'enabled' => false,
                                                'alpha' => 30,
                                                'beta' => 0,
                                                'depth' => 80,
                                                'viewDistance' => 25
                                            ],
                                        ],
                                        'colors' => ['#f7a35c', '#91e8e1', '#8085e9', '#1d599d', '#7cb5ec', '#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
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
                                        'series' => Cdata::getReportservice298()
                                    ]
                                ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">TOP 10 ผลงานเบาหวาน ได้รับตรวจจอประสาทตา</h3>
                                </div>

                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    ],
                                    'options' => [
                                        'chart' => [
                                            'type' => 'bar',
                                            'height' => '260',
                                            'options3d' => [
                                                'enabled' => false,
                                                'alpha' => 30,
                                                'beta' => 0,
                                                'depth' => 80,
                                                'viewDistance' => 25
                                            ],
                                        ],
                                        'plotOptions' => [
                                            'series' => [
                                                'dataLabels' => ['enabled' => true, 'format' => '{point.y:.1f}%', 'borderWidth' => 0,],
                                            ],
                                        ],
                                        'colors' => ['#91e8e1', '#91e8e1', '#8085e9', '#1d599d', '#7cb5ec', '#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
                                        'title' => ['text' => ''],
                                        'xAxis' => [
                                            'type' => 'category',
                                        ],
                                        'legend' => [
                                            'enabled' => false
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'เบาหวาน ได้รับตรวจจอประสาทตา'],
                                            'max' => 200
                                        ],
                                        'credits' => ['enabled' => false],
                                        'series' => Cdata::getDmRetina('asc')
                                    ]
                                ]);
                                ?>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">LOW 10 ผลงานเบาหวาน ได้รับตรวจจอประสาทตา</h3>
                                </div>

                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    ],
                                    'options' => [
                                        'chart' => [
                                            'type' => 'bar',
                                            'height' => '260',
                                            'options3d' => [
                                                'enabled' => false,
                                                'alpha' => 30,
                                                'beta' => 0,
                                                'depth' => 80,
                                                'viewDistance' => 25
                                            ],
                                        ],
                                        'plotOptions' => [
                                            'series' => [
                                                'dataLabels' => ['enabled' => true, 'format' => '{point.y:.1f}%', 'borderWidth' => 0,],
                                            ],
                                        ],
                                        'colors' => ['#f7a35c', '#91e8e1', '#8085e9', '#1d599d', '#7cb5ec', '#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
                                        'title' => ['text' => ''],
                                        'xAxis' => [
                                            'type' => 'category'
                                        ],
                                        'legend' => [
                                            'enabled' => false,
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'เบาหวาน ได้รับตรวจจอประสาทตา'],
                                            'max' => 100
                                        ],
                                        'credits' => ['enabled' => false],
                                        'series' => Cdata::getDmRetina('desc')
                                    ]
                                ]);
                                ?>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">TOP 10 ผลงาน KPI ผู้ป่วยโรคเบาหวานที่ควบคุมระดับน้ำตาลได้ดี</h3>
                                </div>

                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    ],
                                    'options' => [
                                        'chart' => [
                                            'type' => 'bar',
                                            'height' => '260',
                                            'options3d' => [
                                                'enabled' => false,
                                                'alpha' => 30,
                                                'beta' => 0,
                                                'depth' => 80,
                                                'viewDistance' => 25
                                            ],
                                        ],
                                        'plotOptions' => [
                                            'series' => [
                                                'dataLabels' => ['enabled' => true, 'format' => '{point.y:.1f}%', 'borderWidth' => 0,],
                                            ],
                                        ],
                                        'colors' => ['#91e8e1', '#91e8e1', '#8085e9', '#1d599d', '#7cb5ec', '#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
                                        'title' => ['text' => ''],
                                        'xAxis' => [
                                            'type' => 'category',
                                        ],
                                        'legend' => [
                                            'enabled' => false
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'KPI ร้อยละผู้ป่วยโรคเบาหวานที่ควบคุมระดับน้ำตาลได้ดี'],
                                            'max' => 200
                                        ],
                                        'credits' => ['enabled' => false],
                                        'series' => Cdata::getDmControl('asc')
                                    ]
                                ]);
                                ?>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">LOW 10 ผลงาน KPI ผู้ป่วยโรคเบาหวานที่ควบคุมระดับน้ำตาลได้ดี</h3>
                                </div>

                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    ],
                                    'options' => [
                                        'chart' => [
                                            'type' => 'bar',
                                            'height' => '260',
                                            'options3d' => [
                                                'enabled' => false,
                                                'alpha' => 30,
                                                'beta' => 0,
                                                'depth' => 80,
                                                'viewDistance' => 25
                                            ],
                                        ],
                                        'plotOptions' => [
                                            'series' => [
                                                'dataLabels' => ['enabled' => true, 'format' => '{point.y:.1f}%', 'borderWidth' => 0,],
                                            ],
                                        ],
                                        'colors' => ['#f7a35c', '#91e8e1', '#8085e9', '#1d599d', '#7cb5ec', '#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
                                        'title' => ['text' => ''],
                                        'xAxis' => [
                                            'type' => 'category'
                                        ],
                                        'legend' => [
                                            'enabled' => false,
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'KPI ร้อยละผู้ป่วยโรคเบาหวานที่ควบคุมระดับน้ำตาลได้ดี'],
                                            'max' => 100
                                        ],
                                        'credits' => ['enabled' => false],
                                        'series' => Cdata::getDmControl('desc')
                                    ]
                                ]);
                                ?>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">TOP 10 ผลงาน KPI พัฒนาการเด็ก 18,30 เดือน ได้รับการตรวจพัฒนาการ</h3>
                                </div>

                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    ],
                                    'options' => [
                                        'chart' => [
                                            'type' => 'bar',
                                            'height' => '260',
                                            'options3d' => [
                                                'enabled' => false,
                                                'alpha' => 30,
                                                'beta' => 0,
                                                'depth' => 80,
                                                'viewDistance' => 25
                                            ],
                                        ],
                                        'plotOptions' => [
                                            'series' => [
                                                'dataLabels' => ['enabled' => true, 'format' => '{point.y:.1f}%', 'borderWidth' => 0,],
                                            ],
                                        ],
                                        'colors' => ['#91e8e1', '#91e8e1', '#8085e9', '#1d599d', '#7cb5ec', '#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
                                        'title' => ['text' => ''],
                                        'xAxis' => [
                                            'type' => 'category',
                                        ],
                                        'legend' => [
                                            'enabled' => false
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'KPI จังหวัด ร้อยละเด็กอายุ 18,30 เดือน ได้รับการคัดกรองพัฒนาการทุกคน'],
                                            'max' => 200
                                        ],
                                        'credits' => ['enabled' => false],
                                        'series' => Cdata::getKpiChildev1830('asc')
                                    ]
                                ]);
                                ?>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">LOW 10 ผลงาน KPI พัฒนาการเด็ก 18,30 เดือน ได้รับการตรวจพัฒนาการ</h3>
                                </div>

                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    ],
                                    'options' => [
                                        'chart' => [
                                            'type' => 'bar',
                                            'height' => '260',
                                            'options3d' => [
                                                'enabled' => false,
                                                'alpha' => 30,
                                                'beta' => 0,
                                                'depth' => 80,
                                                'viewDistance' => 25
                                            ],
                                        ],
                                        'plotOptions' => [
                                            'series' => [
                                                'dataLabels' => ['enabled' => true, 'format' => '{point.y:.1f}%', 'borderWidth' => 0,],
                                            ],
                                        ],
                                        'colors' => ['#f7a35c', '#91e8e1', '#8085e9', '#1d599d', '#7cb5ec', '#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
                                        'title' => ['text' => ''],
                                        'xAxis' => [
                                            'type' => 'category'
                                        ],
                                        'legend' => [
                                            'enabled' => false,
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'KPI จังหวัด ร้อยละเด็กอายุ 18,30 เดือน ได้รับการคัดกรองพัฒนาการทุกคน'],
                                            'max' => 100
                                        ],
                                        'credits' => ['enabled' => false],
                                        'series' => Cdata::getKpiChildev1830('desc')
                                    ]
                                ]);
                                ?>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">TOP 10 ผลงาน KPI หญิงตั้งครรภ์ที่ได้รับการดูแลก่อนคลอด 5 ครั้ง ตามเกณฑ์</h3>
                                </div>

                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    ],
                                    'options' => [
                                        'chart' => [
                                            'type' => 'bar',
                                            'height' => '260',
                                            'options3d' => [
                                                'enabled' => false,
                                                'alpha' => 30,
                                                'beta' => 0,
                                                'depth' => 80,
                                                'viewDistance' => 25
                                            ],
                                        ],
                                        'plotOptions' => [
                                            'series' => [
                                                'dataLabels' => ['enabled' => true, 'format' => '{point.y:.1f}%', 'borderWidth' => 0,],
                                            ],
                                        ],
                                        'colors' => ['#91e8e1', '#91e8e1', '#8085e9', '#1d599d', '#7cb5ec', '#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
                                        'title' => ['text' => ''],
                                        'xAxis' => [
                                            'type' => 'category'
                                        ],
                                        'legend' => [
                                            'enabled' => false
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'KPI ร้อยละหญิงตั้งครรภ์ที่ได้รับการดูแลก่อนคลอด 5 ครั้ง ตามเกณฑ์'],
                                            'max' => 200
                                        ],
                                        'credits' => ['enabled' => false],
                                        'series' => Cdata::getKpiAnc5('asc')
                                    ]
                                ]);
                                ?>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">LOW 10 ผลงาน KPI หญิงตั้งครรภ์ที่ได้รับการดูแลก่อนคลอด 5 ครั้ง ตามเกณฑ์</h3>
                                </div>

                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    ],
                                    'options' => [
                                        'chart' => [
                                            'type' => 'bar',
                                            'height' => '260',
                                            'options3d' => [
                                                'enabled' => false,
                                                'alpha' => 30,
                                                'beta' => 0,
                                                'depth' => 80,
                                                'viewDistance' => 25
                                            ],
                                        ],
                                        'plotOptions' => [
                                            'series' => [
                                                'dataLabels' => ['enabled' => true, 'format' => '{point.y:.1f}%', 'borderWidth' => 0,],
                                            ],
                                        ],
                                        'colors' => ['#f7a35c', '#91e8e1', '#8085e9', '#1d599d', '#7cb5ec', '#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
                                        'title' => ['text' => ''],
                                        'xAxis' => [
                                            'type' => 'category'
                                        ],
                                        'legend' => [
                                            'enabled' => false
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'KPI ร้อยละหญิงตั้งครรภ์ที่ได้รับการดูแลก่อนคลอด 5 ครั้ง ตามเกณฑ์'],
                                            'max' => 100
                                        ],
                                        'credits' => ['enabled' => false],
                                        'series' => Cdata::getKpiAnc5('desc')
                                    ]
                                ]);
                                ?>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">TOP 10 ผลงาน KPI หญิงตั้งครรภ์ได้รับการฝากครรภ์ครั้งแรกก่อนหรือเท่ากับ 12 สัปดาห์</h3>
                                </div>

                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    ],
                                    'options' => [
                                        'chart' => [
                                            'type' => 'bar',
                                            'height' => '260',
                                            'options3d' => [
                                                'enabled' => false,
                                                'alpha' => 30,
                                                'beta' => 0,
                                                'depth' => 80,
                                                'viewDistance' => 25
                                            ],
                                        ],
                                        'plotOptions' => [
                                            'series' => [
                                                'dataLabels' => ['enabled' => true, 'format' => '{point.y:.1f}%', 'borderWidth' => 0,],
                                            ],
                                        ],
                                        'colors' => ['#91e8e1', '#91e8e1', '#8085e9', '#1d599d', '#7cb5ec', '#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
                                        'title' => ['text' => ''],
                                        'xAxis' => [
                                            'type' => 'category'
                                        ],
                                        'legend' => [
                                            'enabled' => false
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'KPI จังหวัด ร้อยละหญิงตั้งครรภ์ได้รับการฝากครรภ์ครั้งแรกก่อนหรือเท่ากับ 12 สัปดาห์'],
                                            'max' => 200
                                        ],
                                        'credits' => ['enabled' => false],
                                        'series' => Cdata::getKpiAnc12('asc')
                                    ]
                                ]);
                                ?>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">LOW 10 ผลงาน KPI หญิงตั้งครรภ์ได้รับการฝากครรภ์ครั้งแรกก่อนหรือเท่ากับ 12 สัปดาห์</h3>
                                </div>

                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    ],
                                    'options' => [
                                        'chart' => [
                                            'type' => 'bar',
                                            'height' => '260',
                                            'options3d' => [
                                                'enabled' => false,
                                                'alpha' => 30,
                                                'beta' => 0,
                                                'depth' => 80,
                                                'viewDistance' => 25
                                            ],
                                        ],
                                        'plotOptions' => [
                                            'series' => [
                                                'dataLabels' => ['enabled' => true, 'format' => '{point.y:.1f}%', 'borderWidth' => 0,],
                                            ],
                                        ],
                                        'colors' => ['#f7a35c', '#91e8e1', '#8085e9', '#1d599d', '#7cb5ec', '#90ed7d', '#f15c80', '#e4d354', '#2b908f', '#f45b5b'],
                                        'title' => ['text' => ''],
                                        'xAxis' => [
                                            'type' => 'category'
                                        ],
                                        'legend' => [
                                            'enabled' => false
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'KPI จังหวัด ร้อยละหญิงตั้งครรภ์ได้รับการฝากครรภ์ครั้งแรกก่อนหรือเท่ากับ 12 สัปดาห์'],
                                            'max' => 100
                                        ],
                                        'credits' => ['enabled' => false],
                                        'series' => Cdata::getKpiAnc12('desc')
                                    ]
                                ]);
                                ?>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">พิกัดสถานบริการ</h3>
                                </div>
                                <?php
                                echo Cmap::widget(['zoom' => 11, 'fillColor' => '#FFE4B5', 'height' => 500]);
                                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
