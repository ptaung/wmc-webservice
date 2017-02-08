<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 *
 */

namespace app\modules\hdcservice\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use app\models\Chospital;
use kartik\widgets\Select2;
#use yii\web\JsExpression;
use kartik\daterange\DateRangePicker;
use app\models\Campur;
#use app\modules\report\models\Ctambon;
use app\modules\hdcservice\models\MenuItems;
use app\modules\hdcservice\models\Cchangwat;
use app\modules\hdcservice\models\Cmastercup;
use app\modules\hdcservice\models\Czone;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\icons\Icon;

#Icon::map($this);

class Cwidget extends Widget {
    #public $id = 'cwinget';

    public $showHospcode = FALSE;
    public $showAmp = FALSE;
    public $showTmb = FALSE;
    public $showFilterHostpye = FALSE;
    public $showDate = FALSE;
    public $clabel;

    public function init() {
        parent::init();
    }

    public function run() {
        /*
          Modal::begin([
          'options' => [
          'id' => 'filter-modal-report',
          #'autoIdPrefix' => 'wm',
          'tabindex' => false, // important for Select2 to work properly
          #'backdrop' => 'static',
          #'dynamic' => true
          ],
          'header' => '<i class="glyphicon glyphicon-search"></i> <b>ตัวเลือกรายงาน</b>',
          'toggleButton' => [
          'label' => Icon::show('versions', ['class' => 'octicon'], Icon::OCT) . ' ประมวลผล',
          'class' => 'btn btn-danger btn-sm'
          ],
          'closeButton' => [
          'label' => Icon::show('device-desktop', ['class' => 'octicon'], Icon::OCT) . ' ปิดหน้าจอ',
          'class' => 'btn btn-primary btn-sm pull-right',
          ],
          'size' => 'modal-lg',
          'footer' => '<div class="btn btn-danger btn-sm">
          <i class="glyphicon glyphicon-envelope"></i> ส่ง Email
          </div>
          <div class="btn btn-success btn-sm" onclick="$(\'#fa-spin\').addClass(\'fa-spin \');$(\'#fromFilter\').submit();">
          ' . Icon::show('spinner', ['id' => 'fa-spin']) . ' ประมวลผล
          </div>
          '
          ]);
         *
         */



        echo Html::beginForm(Url::toRoute('rpt/index'), 'get', ['data-pjax' => false, 'id' => 'fromFilter']);
        echo Html::hiddenInput('items', \Yii::$app->request->get('items'));
        #echo Html::hiddenInput('clabel', $this->clabel);
#f ($this->showFilterHostpye)
        #echo $this->showFilterHostpye(); //การแสดงผล
        echo '<div class="rows">';
        echo '<div class="row">';
        echo '<div class="col-md-4">';
        echo $this->showBudgetYear();
        echo '</div>';
        echo '</div>';

        echo '<div class="row">';
        echo '<div class="col-md-4">';
        echo $this->showZone(); //แสดงเขต
        echo '</div>';

        echo '<div class="col-md-4">';
        echo $this->showChw(); //แสดงจังหวัด
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="col-md-4">';
        echo $this->showAmp(); //แสดงอำเภอ
        echo '</div>';

        echo '<div class="col-md-4">';
        echo $this->showTmb(); //แสดงตำบล
        echo '</div>';
        echo '</div>';

        echo '<div class="row">';
        echo '<div class="col-md-4">';
        echo $this->showCup(); //แสดง Cup
        echo '</div>';

        echo '<div class="col-md-4">';
        echo $this->showHospital(); //แสดงหน่วยบริการ
        echo '</div>';
        echo '</div>';
        echo Html::hiddenInput('onsubmit', 1);
        echo '<div class="row">';
        echo '<div class="col-md-12">';
        echo '<br>';
        echo Html::submitButton('ตกลง', ['class' => 'btn btn-lg btn-success', 'name' => 'hash-button']);
        echo '</div>';
        echo '</div>';
        echo '</div>';
//จบการแสดง form
        echo Html::endForm();

#Modal::end();
    }

    public static function getMenuDetail($item) {
        $model = MenuItems::find()->where('menu_items_id =' . $item)->one();
        return $model;
    }

    public static function showDateFilter() {
        $ref = '<label class="control-label">วันที่ให้บริการ</label>';
        $ref.= '<div class="drp-container">';
        $ref.= DateRangePicker::widget([
                    'name' => 'filterDate',
                    'id' => 'ft_filterDate',
                    'useWithAddon' => true,
                    'presetDropdown' => true,
                    'hideInput' => true,
                    'convertFormat' => true,
                    'language' => 'TH',
                    'value' => (isset($_GET['filterDate']) ? $_GET['filterDate'] : date('Y-m-d') . ' to ' . date('Y-m-d')),
                    'pluginOptions' => [
                        'locale' => [
                            #'format' => 'd-M-Y',//Thai format
                            'format' => 'Y-m-d',
                            'separator' => ' to ',
                            'applyLabel' => 'เลือกวันที่',
                            'cancelLabel' => 'ยกเลิก',
                            'weekLabel' => 'สัปดาห์ที่แล้ว',
                            'customRangeLabel' => 'กำหนดช่วงวันที่เอง',
                        ],
                        'ranges' => [
                            Yii::t('app', "ปีงบ 2558") => ["moment.startDate='2014-10-01'", "moment.endDate='2015-09-30'"],
                            Yii::t('app', "ปีงบ 2559") => ["moment.startDate='2015-10-01'", "moment.endDate='2016-09-30'"],
                            Yii::t('app', "ปีงบ 2560") => ["moment.startDate='2016-10-01'", "moment.endDate='2017-09-30'"],
                            Yii::t('app', "ปีงบ 2561") => ["moment.startDate='2017-10-01'", "moment.endDate='2018-09-30'"],
                            Yii::t('app', "ปีงบ 2562") => ["moment.startDate='2018-10-01'", "moment.endDate='2019-09-30'"],
                            Yii::t('app', "วันนี้") => ["moment().startOf('day')", "moment()"],
                            Yii::t('app', "เมื่อวานนี้") => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
                            Yii::t('app', "{n} วันทีแล้ว", ['n' => 7]) => ["moment().startOf('day').subtract(6, 'days')", "moment()"],
                            Yii::t('app', "{n} วันทีแล้ว", ['n' => 30]) => ["moment().startOf('day').subtract(29, 'days')", "moment()"],
                            Yii::t('app', "เดือนนี้") => ["moment().startOf('month')", "moment().endOf('month')"],
                            Yii::t('app', "เดือนที่แล้ว") => ["moment().subtract(1, 'month').startOf('month')", "moment().subtract(1, 'month').endOf('month')"],
                        ]
                    ]
        ]);
        $ref.= '</div>';
        return $ref;
    }

#--------------------------------------------------------------------------
#แสดงปีงบประมาณ

    public static function showBudgetYear() {
        $ref = Html::label('ปีงบประมาณ', 'repyear');
        $ref.= Select2::widget([
                    'name' => 'filterByear',
                    'attribute' => 'filterByear',
                    'value' => (isset($_GET['filterByear']) ? $_GET['filterByear'] : ''),
                    'data' => ['2557' => '2557', '2558' => '2558', '2559' => '2559'],
                    'options' => ['placeholder' => 'เลือกปีงบประมาณ ...'],
                    'id' => 'filterByear_id',
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
        ]);
        return $ref;
    }

#--------------------------------------------------------------------------

    public static function showInputFilter() {
        $ref = '<label class="control-label">ค้นหา</label>';
        $ref.= Html::input('text', 'filterSearch', (isset($_GET['filterSearch']) ? $_GET['filterSearch'] : ''), ['class' => 'form-control']);
        return $ref;
    }

    public static function showZone() {
        $ref = '<label class="control-label">เขต</label>';
        $ref.= Select2::widget([
                    'name' => 'filterZone',
                    'attribute' => 'filterZone',
                    'value' => (isset($_GET['filterZone']) ? $_GET['filterZone'] : ''),
                    'data' => ArrayHelper::map(Czone::find()->all(), 'zonecode', 'zonename'),
                    'options' => ['placeholder' => 'เลือกเขต ...'],
                    'id' => 'filterZone_id',
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
        ]);
        return $ref;
    }

    public static function showCup() {
        $ref = '<label class="control-label">เครือข่าย</label>';
        $ref.= Select2::widget([

                    'name' => 'filterCup',
                    'attribute' => 'filterCup',
                    'value' => (isset($_GET['filterCup']) ? $_GET['filterCup'] : ''),
                    'data' => ArrayHelper::map(Cmastercup::find()->all(), 'hmain', 'hmainname'),
                    'options' => ['placeholder' => 'เลือกเครือข่าย ...'],
                    'id' => 'filterCup_id',
                    'pluginOptions' => [
                        'allowClear' => true,
                    #'initialize' => true,
                    ],
        ]);
        return $ref;
    }

    public static function showChw() {
        $ref = '<label class="control-label">จังหวัด</label>';
        $ref.= DepDrop::widget([
                    'type' => DepDrop::TYPE_SELECT2,
                    'name' => 'filterChw',
                    'attribute' => 'filterChw',
                    'options' => [
                        'placeholder' => 'เลือกจังหวัด ...',
                        'prompt' => 'เลือกทั้งหมด...',
                        'class' => 'form-control input-sm'
                    ],
                    'id' => 'filterChw_id',
                    #'value' => (isset($_GET['filterChw']) ? $_GET['filterChw'] : ''),
                    'pluginOptions' => [
                        'depends' => ['filterZone_id'],
                        'allowClear' => true,
                        'loadingText' => 'Loading...',
                        'placeholder' => 'ทั้งหมด...',
                        'url' => Url::to(['/hdcservice/default/getchw', 'selected' => (isset($_GET['filterChw']) ? $_GET['filterChw'] : '')]),
                        'initialize' => false,
                    ],
        ]);
        return $ref;
    }

    public static function showAmp() {
        $ref = '<label class="control-label">อำเภอ</label>';
        $ref.= DepDrop::widget([
                    'type' => DepDrop::TYPE_SELECT2,
                    'name' => 'filterAmp',
                    'attribute' => 'filterAmp',
                    'options' => [
                        'placeholder' => 'เลือกอำเภอ ...',
                        'prompt' => 'เลือกทั้งหมด...',
                        'class' => 'form-control input-sm'
                    ],
                    'id' => 'filterAmp_id',
                    #'value' => (isset($_GET['filterAmp']) ? $_GET['filterAmp'] : ''),
                    'pluginOptions' => [
                        'depends' => ['filterZone_id', 'filterChw_id'],
                        'allowClear' => true,
                        'loadingText' => 'Loading...',
                        'placeholder' => 'ทั้งหมด...',
                        'url' => Url::to(['/hdcservice/default/getamp', 'selected' => (isset($_GET['filterAmp']) ? $_GET['filterAmp'] : '')]),
                        'initialize' => false,
                    ],
        ]);
        return $ref;
    }

    public static function showTmb() {
        $ref = '<label class="control-label">ตำบล</label>';
        $ref.= DepDrop::widget([
                    'type' => DepDrop::TYPE_SELECT2,
                    'name' => 'filterTmb',
                    'attribute' => 'filterTmb',
                    'options' => [
                        'placeholder' => 'เลือกตำบล ...',
                        'prompt' => 'เลือกทั้งหมด...',
                        'class' => 'form-control input-sm'
                    ],
                    #'value' => (isset($_GET['filterTmb']) ? $_GET['filterTmb'] : ''),
                    'pluginOptions' => [
                        'depends' => ['filterZone_id', 'filterChw_id', 'filterAmp_id'],
                        'allowClear' => true,
                        'loadingText' => 'Loading...',
                        'placeholder' => 'ทั้งหมด...',
                        'url' => Url::to(['/hdcservice/default/gettmp', 'selected' => (isset($_GET['filterTmb']) ? $_GET['filterTmb'] : '')]),
                        'initialize' => true,
                    //'initDepends' => ['filterZone_id'],
                    ],
        ]);
        return $ref;
    }

    public static function showHospital() {
        $ref = '<label class="control-label">หน่วยบริการ</label>';
        $ref.= Select2::widget([

                    'name' => 'filterHospital',
                    'attribute' => 'filterHospital',
                    'value' => (isset($_GET['filterHospital']) ? $_GET['filterHospital'] : ''),
                    'data' => ArrayHelper::map(Cchangwat::find()->all(), 'changwatcode', 'changwatname'),
                    'options' => ['placeholder' => 'เลือกหน่วยบริการ ...'],
                    'id' => 'filterHospital_id',
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
        ]);
        return $ref;
    }

    public static function showHospcode() {
        $ref = '<label class="control-label">หน่วยบริการ</label>';
        $ref.= DepDrop::widget([
                    'name' => 'filterHospcode',
                    'attribute' => 'filterHospcode',
                    'value' => (isset($_GET['filterHospcode']) ? $_GET['filterHospcode'] : ''),
                    'data' => ArrayHelper::map(Chospital::Listdata(), 'hoscode', 'fullname'),
                    'options' => ['placeholder' => 'เลือกสถานบริการ ...'],
                    'id' => 'filterHospcode_id',
                    'pluginOptions' => [
                        'depends' => ['filterAmp_id'],
                        'allowClear' => true,
                        'loadingText' => 'Loading...',
                        'url' => Url::to(['/webclient/default/gethoscode']),
                    ],
        ]);
        return $ref;
    }

    public static function showMap() {

    }

}
