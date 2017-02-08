<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;
use yii\widgets\Pjax;

$this->title = 'รายชื่อเป้าหมายหญิงคลอดที่ต้องดูแลหลังคลอด 3 ครั้ง ในเขตรับผิดชอบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['id' => 'gdData', 'timeout' => false, 'enablePushState' => false,]) ?>
<div class="menu-group-index">
    <?php
    $y = date('Y') - 2;
    $s = date('Y') + 2;
    for ($y; $y < $s; $y++) {
        $byear[$y] = $y + 543;
    }
#current budgetyear
    if ((int) date('Ym') >= (int) (date('Y') . '10') OR (int) date('Ym') >= (int) (date('Y') . '11')OR (int) date('Ym') >= (int) (date('Y') . '12')) {
        $budgetyear = date('Y') + 1;
    } else {
        $budgetyear = date('Y');
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
    $data = Chospital::find()->where("hostype in ('03','05','06','07','18' ) $ampcode and provcode = '{$provcode}' {$sqlStringAdd}")->orderBy('hoscode')->all();
    ?>
    <?php
    /*
      if (isset($_GET['q_hospcode']))
      echo app\modules\webclient\components\Cmapclient::widget(['point' => $point, 'zoom' => 14, 'height' => 300,
      # 'content' => '<br>ความพิการ {person_deformed_type_name}'
      'icon' => 'https://cdn3.iconfinder.com/data/icons/user-icons/32/Baby_32.png']);
     *
     */
    ?>
    <?=
    GridView::widget([

        'export' => [
            #'fontAwesome' => true,
            'showConfirmAlert' => false,
            'target' => GridView::TARGET_BLANK,
            'label' => 'ส่งออกรายงาน',
        ],
        'exportConfig' => [
            GridView::EXCEL => ['label' => 'บันทึกเป็น EXCEL'],
        #GridView::PDF => ['label' => 'บันทึกเป็น PDF'],
        ],
        #'pjax' => true,
        'responsiveWrap' => false,
        #'floatHeader' => true,
        #'export' => false,
        'layout' => '<div class="box box-success">
<div class="box-header with-border">
<i class="fa fa-fw fa-list-ul" style="color: #1E8000;"></i> <b>' . $this->title . '</b>
<div class="box-tools pull-right">{summary}</div>
</div>
<div class="box-body">

        <div class="btn-group" role="group" aria-label="">
        <form class="navbar-form navbar-left" method="GET" role="search" data-pjax="true">
          <div class="form-group">
          <div class="input-group">
          <div class="input-group-addon bg-yellow disabled color-palette"><i class="fa fa-fw fa-search"></i></div>
          ' . Html::textInput('q_search', $_GET['q_search'], ['class' => 'form-control input-sm', 'style' => 'width:100px;', 'placeholder' => 'ค้นหารายชื่อ-เลข 13 หลัก']) . '
          </div>
          ' . Html::dropDownList('q_byear', (isset($_GET['q_byear']) ? $_GET['q_byear'] : $budgetyear), $byear, ['class' => 'form-control input-sm', 'style' => 'width:80px;', 'prompt' => ' ++ปีงบประมาณ++']) . '
          ' . Html::dropDownList('q_hospcode', $dataselect, \yii\helpers\ArrayHelper::map($data, 'hoscode', 'fullname'), ['class' => 'form-control input-sm', 'style' => 'width:200px;', 'prompt' => ' ++เลือกทุกสถานบริการ++']) . '
          <input value="' . $_GET['q_screentype'] . '" name="q_screentype" type="hidden">
          <button type="submit" class="btn btn-success btn-sm">ตกลง</button>

          </div>
          </form>
           </div>
          <small>{toolbar}</small>{items}{pager}
</div>
</div>',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ผลงาน',
                'attribute' => 'result',
                'format' => 'raw',
                'value' => function($data) {
                    $result = '';
                    if ($data['result'] == '1') {
                        $result = 'ครบ'; #Cwebclient::getThaiDate($data['date_serv']);
                        $color = 'success';
                    } else {
                        $result = '-';
                        $color = 'default';
                    }

                    return "<button class='btn btn-xs btn-{$color} col-md-12'>" . $result . "</button>";
                },
            ],
            [
                'label' => 'Lookup',
                'attribute' => 'lookuptarget',
            ],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                /*
                  'detailUrl' => yii\helpers\Url::toRoute(['target/targetanc3detail']),
                 */
                'detail' => function ($model, $key, $index, $column) {
                    $dataProvider = app\modules\webclient\controllers\TargetController::TargetAnc3Detail(['cid' => $model['cid'], 'bdate' => $model['bdate']]);
                    return Yii::$app->controller->renderPartial('_targetanc3-details', ['dataProvider' => $dataProvider]);
                },
                        'detailOptions' => [
                            'class' => 'kv-state-enable',
                        ],
                        'headerOptions' => ['class' => 'kartik-sheet-style'],
                        'expandOneOnly' => true
                    ],
                    [
                        'label' => 'ชื่อ-สกุล',
                        'attribute' => 'person_name',
                        'format' => 'raw',
                        'value' => function($data) {
                            return '<b>' . $data['cid'] . '</b><br><small>' . $data['person_name'] . '</small>';
                        }
                    ],
                    [
                        'label' => 'ตั้งครรภ์ครั้งที่',
                        'attribute' => 'gravida',
                    ],
                    [
                        'label' => 'PID',
                        'attribute' => 'pid2',
                    ],
                    [
                        'label' => 'วันที่คลอด',
                        'attribute' => 'bdate',
                        'format' => 'raw',
                        'value' => function($data) {
                            return Cwebclient::getThaiDate($data['bdate']);
                        }
                    ],
                    [
                        'label' => 'สถานที่คลอด',
                        'attribute' => 'bhosp',
                    ],
                    [
                        'label' => '#',
                        'value' => function($data) {
                            return '';
                        }
                    ],
                    [
                        'label' => 'สถานะการอยู่อาศัย',
                        'attribute' => 'check_typearea',
                        'visible' => 0,
                    ],
                    [
                        'label' => 'บริการ 1',
                        'attribute' => 's1',
                        'format' => 'raw',
                        'value' => function($data) {
                            return ($data['s1'] <> '' ? $data['s1'] : '');
                        }
                    ],
                    [
                        'label' => 'บริการ 2',
                        'attribute' => 's2',
                        'format' => 'raw',
                        'value' => function($data) {
                            return ($data['s2'] <> '' ? $data['s2'] : '');
                        }
                    ],
                    [
                        'label' => 'บริการ 3',
                        'attribute' => 's3',
                        'format' => 'raw',
                        'value' => function($data) {
                            return ($data['s3'] <> '' ? $data['s3'] : '');
                        }
                    ],
                    [
                        'label' => 'หมายเหตุ',
                        'attribute' => 'etc',
                        'format' => 'raw',
                    ],
                ],
            ]);
            ?>
        </div>
        <?php Pjax::end(); ?>