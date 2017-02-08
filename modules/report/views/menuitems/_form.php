<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\report\models\MenuGroup;
use app\modules\report\models\MenuItems;
use yii\helpers\ArrayHelper;
use conquer\codemirror\CodemirrorWidget;
#use conquer\codemirror\CodemirrorWidget;
use conquer\codemirror\CodemirrorAsset;
use app\modules\report\components\Report;
use kartik\growl\Growl;
use yii\widgets\Pjax;
use kartik\icons\Icon;

Icon::map($this);
Icon::map($this, Icon::OCT);
/* @var $this yii\web\View */
/* @var $model app\models\MenuItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-items-form">
    <?php Pjax::begin(['id' => 'ReportPjax', 'enablePushState' => false]) ?>
    <?php if (\Yii::$app->session->hasFlash('success')): ?>
        <?php
        echo Growl::widget([
            'type' => Growl::TYPE_SUCCESS,
            'title' => Yii::$app->params['systemName'],
            'icon' => 'glyphicon glyphicon-ok-sign',
            'body' => \Yii::$app->session->getFlash('success'),
            'showSeparator' => true,
            'delay' => 2,
            'pluginOptions' => [
                'showProgressbar' => false,
                'placement' => [
                    'from' => 'bottom',
                    'align' => 'right',
                ]
            ]
        ]);
        ?>
        <!--
            <div class="alert alert-success">
        <?php echo \Yii::$app->session->getFlash('success'); ?>
            </div>
        -->
    <?php endif; ?>

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'menu_items_name')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-12 hidden">
                    <?php #= $form->field($model, 'menu_items_url')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'menu_group_id')->dropDownList(ArrayHelper::map(MenuGroup::find()->all(), 'menu_group_id', 'menu_group_name'), ['prompt' => '--เลือกรายการ--']) ?>
                    <?php #= $form->field($model, 'menu_items_active')->textInput(['maxlength' => true])        ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'menu_items_typeprocess')->dropDownList(['oneprocess' => 'Run คำสั่งทั่วไป', 'manyprocess' => 'Run คำสั่งตามหน่วยบริการ']); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'menu_items_datasource')->dropDownList(Report::getListDb()); ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'menu_items_comment')->textarea(['rows' => 10]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'menu_items_status')->dropDownList(MenuItems::getStatus()); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'menu_items_active')->dropDownList(['1' => 'ใช้งาน', '0' => 'ปิดการใช้งาน']); ?>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'สร้างใหม่' : 'แก้ไขรายการ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <?php #= $form->field($model, 'menu_items_sqlquery')->textarea(['rows' => 15])     ?>
                    <div class="thumbnail">

                        <?php
                        echo '<div class="btn-group" role="group" aria-label="">';
                        echo Html::a(Icon::show('code', ['class' => 'octicon'], Icon::OCT) . ' ทดสอบคำสั่ง', ['/report/rpt', 'items' => $model->menu_items_id], ['class' => 'btn btn-info btn-sm']);
                        echo Html::button(Icon::show('list-ordered', ['class' => 'octicon'], Icon::OCT) . ' SET COLUMNS', ['class' => 'btn btn-default btn-sm']);
                        echo Html::button(Icon::show('list-ordered', ['class' => 'octicon'], Icon::OCT) . ' ตัวอย่างคำสั่ง', ['class' => 'btn btn-default btn-sm', 'data-toggle' => 'modal', 'data-target' => '#myModal']);
                        echo '</div>';
                        echo $form->field($model, 'menu_items_sqlquery')->widget(
                                CodemirrorWidget::className(), [
                            'assets' => [
                                CodemirrorAsset::MODE_CLIKE,
                                CodemirrorAsset::MODE_SQL,
                                CodemirrorAsset::KEYMAP_EMACS,
                                CodemirrorAsset::ADDON_EDIT_MATCHBRACKETS,
                                CodemirrorAsset::ADDON_COMMENT,
                                CodemirrorAsset::ADDON_DIALOG,
                                CodemirrorAsset::ADDON_SEARCHCURSOR,
                                CodemirrorAsset::ADDON_SEARCH,
                                CodemirrorAsset::THEME_ECLIPSE,
                                CodemirrorAsset::ADDON_DISPLAY_FULLSCREEN,
                            ],
                            'settings' => [
                                'lineNumbers' => true,
                                'mode' => 'text/x-mysql',
                            //'keyMap' => 'emacs',
                            //'matchBrackets' => true,
                            ],
                            'options' => ['rows' => 5],
                                ]
                        );
                        ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="thumbnail">
                        <?php #= $form->field($model, 'menu_items_columns')->textarea(['rows' => 15, 'class' => 'form-control text-success'])        ?>
                        <?php
                        echo '<div class="btn-group" role="group" aria-label="">';
                        echo Html::button(Icon::show('code', ['class' => 'octicon'], Icon::OCT) . ' TEST', ['class' => 'btn btn-info btn-sm']);
                        echo Html::button(Icon::show('list-ordered', ['class' => 'octicon'], Icon::OCT) . ' ตัวอย่างคำสั่ง', ['class' => 'btn btn-default btn-sm', 'data-toggle' => 'modal', 'data-target' => '#myModal']);
                        echo '</div>';
                        echo $form->field($model, 'menu_items_columns')->widget(
                                CodemirrorWidget::className(), [
                            'preset' => 'php',
                            'options' => ['rows' => 40],
                                ]
                        );
                        ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="thumbnail">
                        <?php #= $form->field($model, 'menu_items_param')->textarea(['rows' => 1]) ?>
                        <?php
                        echo $form->field($model, 'menu_items_param')->widget(
                                CodemirrorWidget::className(), [
                            'preset' => 'php',
                            'options' => ['rows' => 40],
                                ]
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ตัวอย่างการใช้คำสั่ง</h4>
                </div>
                <div class="modal-body">
                    ตัวอย่าง ตัวแปรใชคำสั่ง SQL
                    <pre class="code">
<b class="text-danger">{table}</b>     แทนชื่อฐานข้อมูล เฉพาะการประมวลผลแบบ Run คำสั่งตามหน่วยบริการ
<b class="text-danger">{startdate}</b> แทนวันที่เริ่มต้น
<b class="text-danger">{enddate}</b>   แทนวันที่สิ้นสุด
<b class="text-danger">{provcode}</b>  แทนรหัสจังหวัด สองหลัก 72
<b class="text-danger">{amp}</b>       แทนรหัสอำเภอ สี่หลัก 7207
<b class="text-danger">{tmp}</b>       แทนรหัสตำบล หกหลัก 720707
<p>
SELECT *
    FROM {table}vn_stat
    WHERE provcode {provcode}
    and concat(provcode,distcode) {amp}
    and vstdate between {startdate} and {enddate}
</p>
                    </pre>
                    ตัวอย่าง Data Columns <a href="http://demos.krajee.com/grid" target="_blank">ศึกษาเพิ่มเติมได้ที่</a>
                    <pre class="code">
@#COUMNS
['class' => 'kartik\grid\SerialColumn'],
[
    'label' => 'รหัส',
    'attribute' => '<b class="text-danger">hospcode</b>',
    'format' => 'raw',
],
[
    'label' => 'หน่วยบริการ',
    'attribute' => '<b class="text-danger">hosname</b>',
    'format' => 'raw',
],
[
    'label' => 'เป้าหมายเด็ก อายุคบ 4 เดือน',
    'attribute' => '<b class="text-danger">target</b>',
    'format' => ['decimal', 0],
    'contentOptions' => ['class' => 'text-right'],
    'pageSummary'=>true,
    'pageSummaryFunc'=>kartik\grid\GridView::F_SUM,
    'pageSummaryOptions'=>['class'=>'text-right text-warning'],
],
                    </pre>
                    ตัวอย่าง Data Columns HEADER
                    <pre class="code">
@#HEADER
    ['content' => '', 'options' => ['colspan' => 3, 'class' => 'text-center success']],
    ['content' => 'จำนวนข้อมูลผิดพลาด', 'options' => ['colspan' => 4, 'class' => 'text-center warning']],
                    </pre>
                    ตัวอย่าง Data Columns Summary
                    <pre class="code">
'pageSummary'=>function() use ($summary){
    return number_format(($summary['cc_kpi']/$summary['cc'])*100,2);
},
                    </pre>


                    ตัวอย่าง Data Columns Link รายชื่อ
                    <pre class="code">

[
    'label' => '#',
    'value' => function($data){
	return \yii\helpers\Html::a('รายชื่อ',["/{$this->module->id}/rpt"
			,'items'=><b class="text-danger">39</b>
			,'filterDate'=>$_GET['filterDate']
			,'link'=>$data['hoscode']
			],['target'=>'_blank']);
		  },
    'format' => 'raw',
    'contentOptions' => ['class' => 'text-right'],
],
                    </pre>
                    ตัวอย่างการใช้งาน Chart <a href="http://www.highcharts.com/demo" target="_blank">ศึกษาเพิ่มเติมได้ที่</a>
                    <pre class="code">
[
    'type' => 'column',
    'cat' => 'hosname',
    'series' => [
	['name' => 'เป้าหมายเด็ก อายุคบ 4 เดือน', 'data' => ['name' => 'hosname', 'value' => 'target']],
	['name' => 'จำนวนเด็กที่ได้รับวัคซีน', 'data' => ['name' => 'hosname', 'value' => 'cc']],
	['name' => 'จำนวน Refer ผู้ป่วยนอก', 'data' => ['name' => 'hosname', 'value' => 'cases_opd']]
    ]
]
                    </pre>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>


</div>
