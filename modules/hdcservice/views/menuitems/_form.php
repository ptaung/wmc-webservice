<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
#use app\modules\hdcservice\models\MenuItems;
use app\modules\hdcservice\models\Sysreport;
use yii\helpers\ArrayHelper;
use conquer\codemirror\CodemirrorWidget;
#use conquer\codemirror\CodemirrorWidget;
use conquer\codemirror\CodemirrorAsset;
#use app\modules\hdcservice\components\Report;
use kartik\widgets\Select2;
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
                    <?php
                    $form->field($model, 'menu_items_id')->dropDownList(
                            ArrayHelper::map(Sysreport::find()->orderBy("report_name ASC")->all(), 'id', 'report_name'), ['prompt' => '--เลือกรายการ--'])
                    ?>
                    <?=
                    $form->field($model, 'menu_items_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Sysreport::find()->orderBy("report_name ASC")->all(), 'id', 'report_name'),
                        'options' => ['placeholder' => 'เลือกรายงาน ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-12">
                    <?php #= $form->field($model, 'menu_items_name')->textInput(['maxlength' => true])  ?>
                </div>
                <div class="col-md-12">
                    <?php #= $form->field($model, 'menu_items_url')->textInput(['maxlength' => true])  ?>
                </div>
                <div class="col-md-12">
                    <?php #= $form->field($model, 'menu_group_id')->dropDownList(ArrayHelper::map(MenuGroup::find()->all(), 'menu_group_id', 'menu_group_name'), ['prompt' => '--เลือกรายการ--'])  ?>
                    <?php #= $form->field($model, 'menu_items_active')->textInput(['maxlength' => true])         ?>
                </div>
                <div class="col-md-6">
                    <?php #= $form->field($model, 'menu_items_typeprocess')->dropDownList(['oneprocess' => 'Run คำสั่งทั่วไป', 'manyprocess' => 'Run คำสั่งตามหน่วยบริการ']);  ?>
                </div>
                <div class="col-md-6">
                    <?php #= $form->field($model, 'menu_items_datasource')->dropDownList(Report::getListDb());  ?>
                </div>
                <div class="col-md-12">
                    <?php #= $form->field($model, 'menu_items_param')->textarea(['rows' => 1])  ?>
                </div>
                <div class="col-md-12">
                    <?php #= $form->field($model, 'menu_items_comment')->textarea(['rows' => 6])  ?>
                </div>
                <div class="col-md-12">
                    <?php #= $form->field($model, 'menu_items_status')->dropDownList(MenuItems::getStatus());  ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'menu_items_active')->dropDownList(['1' => 'ใช้งาน', '0' => 'ปิดการใช้งาน']); ?>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'สร้างใหม่' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <?php #= $form->field($model, 'menu_items_sqlquery')->textarea(['rows' => 15])      ?>
                    <div class="thumbnail">

                        <?php
                        echo '<div class="btn-group" role="group" aria-label="">';
                        echo Html::a(Icon::show('code', ['class' => 'octicon'], Icon::OCT) . ' ทดสอบคำสั่ง', ['/hdcservice/rpt', 'items' => $model->menu_items_id], ['class' => 'btn btn-info btn-sm']);
                        #echo Html::button(Icon::show('list-ordered', ['class' => 'octicon'], Icon::OCT) . ' SET COLUMNS', ['class' => 'btn btn-default btn-sm']);
                        #echo Html::button(Icon::show('list-ordered', ['class' => 'octicon'], Icon::OCT) . ' ตัวอย่างคำสั่ง', ['class' => 'btn btn-default btn-sm']);
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
                        #echo Html::button(Icon::show('code', ['class' => 'octicon'], Icon::OCT) . ' TEST', ['class' => 'btn btn-info btn-sm']);
                        echo $form->field($model, 'menu_items_columns')->widget(
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
        <div class="col-md-12">
            <div class="form-group">
                <?php #= Html::submitButton($model->isNewRecord ? 'สร้างใหม่' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])   ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
