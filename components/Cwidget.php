<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 *
 */

namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
#use app\models\Chospital;
use kartik\widgets\Select2;
#use yii\web\JsExpression;
use kartik\daterange\DateRangePicker;
use app\models\Campur;
#use app\modules\report\models\Ctambon;
use app\modules\report\models\MenuItems;
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

    public function init() {
        parent::init();
    }

    public function run() {
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
                'label' => Icon::show('versions', ['class' => 'octicon'], Icon::OCT) . ' ตัวเลือกประมวลผล',
                'class' => 'btn btn-danger'
            ],
            'closeButton' => [
                'label' => Icon::show('device-desktop', ['class' => 'octicon'], Icon::OCT) . ' ปิดหน้าจอ',
                'class' => 'btn btn-primary btn-sm pull-right',
            ],
            'size' => 'modal-lg',
            'footer' => '<div class="btn btn-danger btn-sm">
                            <i class="glyphicon glyphicon-envelope"></i> ...
                        </div>
                        <div class="btn btn-success btn-sm" onclick="$(\'#fa-spin\').addClass(\'fa-spin \');$(\'#fromFilter\').submit();">
                            ' . Icon::show('spinner', ['id' => 'fa-spin']) . ' ประมวลผล
                        </div>
                        '
        ]);
        echo Html::beginForm(Url::toRoute('rpt/index'), 'get', ['data-pjax' => false, 'id' => 'fromFilter']);
        echo Html::hiddenInput('items', \Yii::$app->request->get('items'));

        //echo $this->showInputFilter(); //คำค้นหา
        #if ($this->showHospcode)
        #echo $this->showHospcode(); //แสดงหน่วยบริการ

        if ($this->showDate) {
            echo $this->showDateFilter();
        } //แสดงวันที่ให้บริการ


        if ($this->showAmp) {
            echo $this->showAmp();
        } //แสดงอำเภอ


        if ($this->showTmb) {
            echo $this->showTmb();
        } //แสดงตำบล

        if ($this->showHospcode) {
            echo $this->showHospcode();
        } //การแสดงหน่วยบริการ

        if ($this->showFilterHostpye) {
            echo $this->showFilterHostpye();
        } //การแสดงผล
//echo $this->showAmp();
        echo Html::hiddenInput('onsubmit', 1);
//จบการแสดง form
        echo Html::endForm();

        Modal::end();
    }

    public static function getMenuDetail($item) {
        $model = MenuItems::find()->where('menu_items_id =' . $item)->one();
        return $model;
    }

    public static function showFilterHostpye() {
        $ref = '<label class="control-label">การแสดงผล</label>';
        $ref.= Html::radioList('filterShow', (isset($_GET['filterShow']) ? $_GET['filterShow'] : 'all'), ['all' => 'ทุกระดับ', 'pcu' => 'รพ.สต.', 'hos' => 'รพ.'], ['class' => 'form-control']);
        return $ref;
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
                    'useWithAddon' => true,
                    'initRangeExpr' => true,
                    #'hideInput' => false,
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

    public static function showInputFilter() {
        $ref = '<label class="control-label">ค้นหา</label>';
        $ref.= Html::input('text', 'filterSearch', (isset($_GET['filterSearch']) ? $_GET['filterSearch'] : ''), ['class' => 'form-control']);
        return $ref;
    }

    public static function showAmp() {
        $ref = '<label class="control-label">อำเภอ</label>';
        $ref.= Select2::widget([
                    'name' => 'filterAmp',
                    'attribute' => 'filterAmp',
                    'value' => (isset($_GET['filterAmp']) ? $_GET['filterAmp'] : ''),
                    'data' => ArrayHelper::map(Campur::Listdata(), 'ampurcodefull', 'ampurname'),
                    'options' => ['placeholder' => 'เลือกอำเภอ ...'],
                    'id' => 'filterAmp_id',
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
        ]);
        return $ref;
    }

    public static function showTmb() {
        $ref = '<label class="control-label">ตำบล</label>';
        $ref.= DepDrop::widget([
                    'name' => 'filterTmp',
                    'attribute' => 'filterTmp',
                    'options' => ['placeholder' => 'เลือกตำบลทั้งหมด ...'],
                    'value' => (isset($_GET['filterTmp']) ? $_GET['filterTmp'] : ''),
                    'pluginOptions' => [
                        'depends' => ['filterAmp_id'],
                        'allowClear' => true,
                        'loadingText' => 'Loading...',
                        'url' => Url::to(['/webclient/default/gettmp']),
                    ],
        ]);
        return $ref;
    }

    public static function showHospcode() {
        $ref = '<label class="control-label">หน่วยบริการ</label>';
        $ref.= DepDrop::widget([
                    'name' => 'filterHospcode',
                    'attribute' => 'filterHospcode',
                    'type' => DepDrop::TYPE_SELECT2,
                    'value' => (isset($_GET['filterHospcode']) ? $_GET['filterHospcode'] : ''),
                    //'data' => ArrayHelper::map(Chospital::Listdata(), 'hoscode', 'fullname'),
                    'options' => ['placeholder' => 'เลือกสถานบริการทั้งหมด ...'],
                    'id' => 'filterHospcode_id',
                    'pluginOptions' => [
                        'depends' => ['filterAmp_id'],
                        'allowClear' => true,
                        'placeholder' => 'ทั้งหมด...',
                        'loadingText' => 'Loading...',
                        'initialize' => true,
                        'url' => Url::to(['/webclient/default/gethoscode', 'selected' => (isset($_GET['filterHospcode']) ? $_GET['filterHospcode'] : '')]),
                    ],
        ]);
        return $ref;
    }

    public static function showMap() {

    }

}
