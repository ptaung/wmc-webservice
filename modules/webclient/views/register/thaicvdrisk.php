<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\report\models\MenuGroup;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;
use miloschuman\highcharts\Highcharts;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายชื่อผู้ป่วยเบาหวานความดันที่มารับบริการ ประเมินความเสี่ยงตาม THAI CV-RISK';
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

    if (!\Yii::$app->user->can('super_admin')) {
        $sqlStringAdd = " and hoscode='{$dataselect}' ";
    }

    $provcode = \Yii::$app->params['provcode'];
    $data = Chospital::find()->where("hostype in ('03','05','06','07','18' ) $ampcode and provcode = '{$provcode}' {$sqlStringAdd}")->orderBy('hoscode ASC')->all();
    #$dataCampur = app\models\Campur::find()->where("changwatcode = '{$provcode}' {$sqlStringAdd}")->all();
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

    <div class="well small" role="alert">
        <h3>
            ขั้นตอนการประเมินโอกาสเสี่ยงโดยการใช้ตารางสี (Color Chart) ที่มา THAI CVDRISK
        </h3>
        <p>
            1. สถานบริการมีการตรวจ Cholesterol โดยใช้ผลการตรวจ Cholesterol ในตาราง opdscreen
        </p>
        <p>
            2. เป็นโรคเบาหวานหรือไม่ ดูจากการขึ้นทะเบียนเบาหวานความดันใน คลินิกพิเศษเบาหวานความดันใน
        </p>
        <p>
            3. เลือกเพศ
        </p>
        <p>
            4. เลือกการสูบบุรี่ ว่าสูบหรือไม่สูบ ถ้าผู้ที่หยุดสูบไม่เกิน 1 ปีก่อนประเมิน ให้เลือกช่องสูบบุรี่
        </p>
        <p>
            5. เลือกช่วงอายุ
        </p>
        <p>
            6. เลือกค่า Systolic blood pressure
        </p>
        <p>
            7. เลือกค่ารอบเอว:หน่วย ซม. น้อยกว่าหรือมากกว่าส่วนสูงหาร 2
        </p>
        <p>
            8. เลือกค่า Cholesterol กรณีที่ทราบค่า Cholesterol
        </p>
        <p>
            ใช้ค่าผล Cholesterol ล่าสุดที่มีการตรวจย้อนหลัง 1 ปีที่เคยมารับบริการ
        </p>
        <p>
            ข้อมูลที่ใช้ในการประเมิน CVD Risk เป็นบริการย้อนหลัง 1 ปี เฉพาะผู้ป่วยมารับบริการ E10-E14 และ I10-I15
        </p>
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
    ' . Html::dropDownList('q_hospcode', $dataselect, \yii\helpers\ArrayHelper::map($data, 'hoscode', 'fullname'), ['class' => 'form-control input-sm', 'prompt' => ' ++เลือกสถานบริการ++']) . '
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
                'label' => 'หมู่บ้าน',
                'attribute' => 'village_name',
                'visible' => 0,
                'group' => true,
                'groupedRow' => true,
            ],
            [
                'label' => 'สถานะเป็นโรค',
                'attribute' => 't_mix_dx',
            /*
              'value' => function($data) {
              $dmht = '';
              if ($data['dm'] > 0)
              $dmht = 'เบาหวาน';
              if ($data['ht'] > 0)
              $dmht = 'ความดัน';
              if ($data['dmht'] > 0)
              $dmht = 'เบาหวาน|ความดัน';

              return $dmht;
              },
             *
             */
            ],
            [
                'label' => 'กลุ่มอายุ',
                'attribute' => 'age',
                'visible' => 0,
            ],
            [
                'label' => 'รอบเอว',
                'attribute' => 'waist',
                'format' => ['decimal', 0]
            ],
            [
                'label' => 'ส่วนสูง',
                'attribute' => 'height',
            ],
            [
                'label' => 'ความดัน',
                'attribute' => 'bps',
                'format' => ['decimal', 0]
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
                'label' => 'จำนวนครั้ง',
                'attribute' => 'cc',
                'visible' => 0,
            ],
            [
                'label' => 'ผลการประเมิน',
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
            [
                'label' => '#',
                'visible' => \Yii::$app->user->can('EMR'),
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a('เพิ่มเติม', 'javascript:;', [

                                'class' => 'btn btn-primary btn-xs activity-view-link',
                                'data-toggle' => 'modal',
                                #'data-target' => '#activity-modal',
                                'data-cid' => $data['cid'],
                                'data-link' => $data['hospcode'],
                    ]);
                }
                    ]
                ],
            ]);
            ?>
            <?php #yii\widgets\Pjax::end()           ?>
        </div>

        <?php
        $this->registerJs(
                "$('.activity-view-link').click(function() {
                    $.get(
                        '" . \yii\helpers\Url::to(['thaicvdloopupdetail']) . "',
                        {
                            cid: $(this).attr('data-cid'),
                            hospcode: $(this).attr('data-link')
                        },
                        function (sdata) {
                            $('.modal-body').html(sdata);
                            $('#activity-modal').modal();
                        }
                    );
                });
                    "
        );



        Modal::begin([
            'header' => '<h2>ข้อมูลประวัติการมารับบริการ</h2>',
            'size' => 'modal-lg',
            #'toggleButton' => ['label' => 'click me'],
            'id' => 'activity-modal'
        ]);

        #echo '<div class="well"></div>';

        Modal::end();
        ?>