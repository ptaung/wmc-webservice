<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\report\models\MenuGroup;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สรุปการประเมินความเสี่ยงตาม THAI CV-RISK';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-group-index">
    <?php
    $y = date('Y') - 2;
    $s = date('Y') + 2;
    for ($y; $y < $s; $y++) {
        $byear[$y] = $y + 543;
    }

    if (strlen(\Yii::$app->params['ampcode']) == 4) {
        $ampcode = " and concat(provcode,distcode) = '" . \Yii::$app->params['ampcode'] . "' ";
    } else {
        $ampcode = '';
    }
    $dataselect = (isset($_GET['q_hospcode']) ? $_GET['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);

    #if (!\Yii::$app->user->can('super_admin')) {
    #$sqlStringAdd = " and hoscode='{$dataselect}' ";
    #}

    $provcode = \Yii::$app->params['provcode'];
    #$data = Chospital::find()->where("hostype in ('01','02','06','07' ) $ampcode and provcode = '{$provcode}' {$sqlStringAdd}")->all();
    $dataCampur = app\models\Campur::find()->where("changwatcode = '{$provcode}' {$sqlStringAdd}")->all();
    ?>
    <?php
    if (isset($_GET['q_hospcode']))
    #echo app\modules\webclient\components\Cmapclient::widget(['point' => $point, 'zoom' => 14, 'height' => 300, 'condition' => 'screen_date']);

        ?>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ระดับสี</th>
                        <th>ระดับการประเมิน</th>
                        <th>ความเสี่ยง</th>
                        <th>จำนวนผู้ป่วย</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>1</th>
                        <td><span class='btn btn-xs col-md-12' style='background:#C0C0C0;width:100%;'></span></td>
                        <td>แปรผลไม่ได้</td>
                        <td>-</td>
                        <td><?= number_format($cvd[0]) ?></td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td><span class='btn btn-xs col-md-12' style='background:#009900;width:100%;'></span></td>
                        <td>เสี่ยงต่ำ</td>
                        <td>< 10%</td>
                        <td><?= number_format($cvd[1]) ?></td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td><span class='btn btn-xs col-md-12' style='background:#FFCC00;width:100%;'></span></td>
                        <td>เสี่ยงปานกลาง</td>
                        <td>10%-20%</td>
                        <td><?= number_format($cvd[2]) ?></td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td><span class='btn btn-xs col-md-12' style='background:#FF6633;width:100%;'></span></td>
                        <td>เสี่ยงสูง</td>
                        <td>20%-30%</td>
                        <td><?= number_format($cvd[3]) ?></td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <td><span class='btn btn-xs col-md-12' style='background:#CC0000;width:100%;'></span></td>
                        <td>เสี่ยงสูงมาก</td>
                        <td>30%-40%</td>
                        <td><?= number_format($cvd[4]) ?></td>
                    </tr>
                    <tr>
                        <th>6</th>
                        <td><span class='btn btn-xs col-md-12' style='background:#660000;width:100%;'></span></td>
                        <td>เสี่ยงสูงอันตราย</td>
                        <td>> 40%</td>
                        <td><?= number_format($cvd[5]) ?></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <th class="text-right">รวม</th>
                        <td><?= number_format(array_sum($cvd)) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
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
                        'polar' => true,
                        'type' => 'line',
                        'height' => '250',
                    ],
                    'title' => ['text' => ''],
                    'xAxis' => [
                        #'type' => 'category'
                        'categories' => ['แปรผลไม่ได้', 'เสี่ยงต่ำ', 'เสี่ยงปานกลาง', 'เสี่ยงสูง', 'เสี่ยงสูงมาก', 'เสี่ยงสูงอันตราย'],
                        'tickmarkPlacement' => 'on',
                        'lineWidth' => 0
                    ],
                    'legend' => [
                        'enabled' => false
                    ],
                    'yAxis' => [
                        'title' => ['text' => '']
                    ],
                    'credits' => ['enabled' => false],
                    'series' => [
                        [ 'name' => 'จำนวนผู้ป่วย',
                            'data' => [$cvd[0], $cvd[1], $cvd[2], $cvd[3], $cvd[4], $cvd[5]],
                            'pointPlacement' => 'on']
                    ]
                ]
            ]);
            ?>
        </div>
    </div>



    <?=
    GridView::widget([
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> ' . $this->title . '</h3>',
            'type' => 'default',
            'before' => '<div class="btn-group" role="group" aria-label="">'
            . '<form class="navbar-form navbar-left" method="GET" role="search" data-pjax="true">
  <div class="form-group">
        ' . Html::dropDownList('q_chronic', (isset($_GET['q_chronic']) ? $_GET['q_chronic'] : $_GET['q_chronic']), ['02' => 'DM', '01' => 'HT', '03' => 'DMHT'], ['class' => 'form-control input-sm', 'prompt' => '++สถานะการเป็นโรค++']) . '
    ' . Html::dropDownList('q_ampurcode', (isset($_GET['q_ampurcode']) ? $_GET['q_ampurcode'] : $_GET['q_ampurcode']), \yii\helpers\ArrayHelper::map($dataCampur, 'ampurcodefull', 'ampurname'), ['class' => 'form-control input-sm', 'prompt' => ' ++เลือกทุกอำเภอ++']) . '
  </div>
  <input value="' . $_GET['q_screentype'] . '" name="q_screentype" type="hidden">
  <button type="submit" class="btn btn-success btn-sm">ตกลง</button>
</form>'
            #. Html::textInput('byear', '', ['class' => 'btn btn-success'])
            #. Html::a('<i class="glyphicon glyphicon-refresh"></i> เบาหวาน', ['index'], ['class' => 'btn btn-success'])
            #. Html::a('<i class="glyphicon glyphicon-refresh"></i> ความดัน', ['index'], ['class' => 'btn btn-warning'])
            . '</div>',
#'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        #'footer' => true
        ],
        'export' => [
            'label' => 'ส่งออกรายงาน',
        ],
        'exportConfig' => [
            GridView::EXCEL => ['label' => 'บันทึกเป็น EXCEL'],
        #GridView::PDF => ['label' => 'บันทึกเป็น PDF'],
        ],
        #'pjax' => true,
        'responsiveWrap' => false,
        'floatHeader' => true,
        #'export' => false,
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'HCODE',
                'attribute' => 'hospcode',
            ],
            [
                'label' => 'เลขบัตรประชาชน',
                'attribute' => 'cid',
                'visible' => 0,
            ],
            [
                'label' => 'ชื่อ-สกุล',
                'attribute' => 'person_name',
            ],
            [
                'label' => 'ที่อยู่',
                'attribute' => 'address',
                'visible' => 0,
            ],
            [
                'label' => 'อายุ',
                'attribute' => 'age_y',
            ],
            [
                'label' => 'สถานะการอยู่อาศัย',
                'attribute' => 'typearea',
                'visible' => 0,
            ],
            [
                'label' => 'ที่อยู่',
                'attribute' => 'check_vhid',
                'visible' => 1,
            #'group' => true,
            #'groupedRow' => true,
            ],
            /*
              [
              'label' => 'สัญชาติ',
              'attribute' => 'nationality',
              ],
             *
             */
            [
                'label' => 'สถานะเป็นโรค',
                'attribute' => 't_mix_dx',
            ],
            [
                'label' => 'กลุ่มอายุ',
                'attribute' => 'age',
                'visible' => 0,
            ],
            [
                'label' => 'รอบเอว',
                'attribute' => 'waist',
            ],
            [
                'label' => 'ส่วนสูง',
                'attribute' => 'height',
            ],
            [
                'label' => 'ความดัน',
                'attribute' => 'bps',
            ],
            [
                'label' => 'สูบบุรี่',
                'attribute' => 'smoking',
                'value' => function($data) {
                    return ($data['smoking'] == 1 ? "สูบ" : ($data['smoking'] == 0 ? "ไม่สูบ" : 'ไม่ระบุ'));
                },
            ],
            [
                'label' => 'TC',
                'attribute' => 'tc',
            ],
            /*
              [
              'label' => 'wh_2',
              'attribute' => 'wh_2',
              ],
              [
              'label' => 'bp',
              'attribute' => 'bp',
              ],
              [
              'label' => 'cholesterol',
              'attribute' => 'cholesterol',
              ],
              'smoke',
              'smoking',
              'has',
              'sex',
              'age',
              'cid',
              'result',
             *
             */
            [
                'label' => 'ผลการประเมิน CVD-RISK',
                'attribute' => 'result',
                'format' => 'raw',
                'value' => function($data) {
                    $result = '';
                    if ($data['result'] == 1) {
                        $result = '< 10 %  ต่ำ';
                        $color = '#009900';
                    } elseif ($data['result'] == 2) {
                        $result = '10-20 % ปานกลาง';
                        $color = '#FFCC00';
                    } elseif ($data['result'] == 3) {
                        $result = '20-30 % สูง';
                        $color = '#FF6633';
                    } elseif ($data['result'] == 4) {
                        $result = '30-40 % สูงมาก';
                        $color = '#CC0000';
                    } elseif ($data['result'] == 5) {
                        $result = '> 40 % อันตราย';
                        $color = '#660000';
                    } else {
                        $result = 'แปรผลไม่ได้';
                        $color = '#C0C0C0';
                    }

                    return "<span class='btn btn-xs col-md-12' style='background:{$color}';width:100%;>" . $result . "</span>";
                },
            ],
        ],
    ]);
    ?>
    <?php #yii\widgets\Pjax::end()          ?>
</div>
