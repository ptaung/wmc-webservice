<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\budgetreq\models\PhItems;
use app\modules\budgetreq\models\PhRequest;
use app\modules\budgetreq\models\PhHospcode;
use app\modules\budgetreq\models\PhReason;
use kartik\widgets\TouchSpin;
use kartik\widgets\FileInput;
use kartik\widgets\Select2

/* @var $this yii\web\View */
/* @var $model app\modules\budgetreq\models\PhOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ph-order-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => '']]); ?>
    <?= $form->errorSummary($model); ?>
    <div class="rows">
        <div class="col-md-6">
            <div class="row">
                <fieldset>
                    <legend class="text-success">ข้อมูลทั่วไป</legend>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                echo $form->field($model, 'items_id')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(PhItems::find()->all(), 'items_id', 'items_name', 'itemsGroup.items_group_name'),
                                    'options' => ['placeholder' => '--เลือกรายการ--', 'disabled' => !$model->isNewRecord, 'class' => 'form-control'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                                ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'request_id')->dropDownList(ArrayHelper::map(PhRequest::find()->all(), 'request_id', 'fullname', 'budget.budget_name'), ['prompt' => '--เลือกรายการ--', 'disabled' => !$model->isNewRecord]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'hospcode')->dropDownList(ArrayHelper::map(PhHospcode::find()->all(), 'hospcode', 'hospcode_name'), ['prompt' => '--เลือกรายการ--', 'disabled' => !$model->isNewRecord]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'reason_id')->dropDownList(ArrayHelper::map(PhReason::find()->all(), 'reason_id', 'reason_name', 'reasonGroup.reason_group_name'), ['prompt' => '--เลือกรายการ--']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'order_reason')->textarea(['rows' => 1]) ?>
                            </div>
                        </div>
                    </div>

                </fieldset>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <?=
                            $form->field($model, 'order_addon')->textInput();
                            ?>
                            <?=
                            $form->field($model, 'order_priority')->textInput();
                            ?>
                            <?=
                            $form->field($model, 'order_amount')->widget(TouchSpin::classname(), [
                                'pluginOptions' => [
                                    'min' => 1,
                                    'max' => 100,
                                    'boostat' => 5,
                                    'maxboostedstep' => 10,
                                ],
                            ]);
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class="text-success">เหตุผล คำชี้แจง</legend>
                        <?= $form->field($model, 'order_reason_present')->textarea(['rows' => 2]) ?>
                        <?= $form->field($model, 'order_reason_conform')->textarea(['rows' => 2]) ?>
                        <?= $form->field($model, 'order_reason_carry')->textarea(['rows' => 2]) ?>
                        <?= $form->field($model, 'order_reason_benefit')->textarea(['rows' => 2]) ?>

                    </fieldset>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <?php if ($model->order_id) { ?>
                        <fieldset>
                            <legend class="text-success">ไฟล์แนบ</legend>
                            <div class="row">
                                <div class="col-md-6">

                                    <?php
                                    echo $form->field($model, 'file_project')->widget(FileInput::classname(), [
                                        'options' => ['multiple' => false],
                                        'pluginOptions' => [
                                            'showUpload' => true,
                                        //'uploadUrl' => Url::to(['/site/uploads']),
                                        ],
                                    ]);
                                    ?> </div>
                                <div class="col-md-6">
                                    <?php
                                    echo $form->field($model, 'file_cost')->widget(FileInput::classname(), [
                                        'options' => ['multiple' => false],
                                        'pluginOptions' => [
                                            'showUpload' => false
                                        ],
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    echo $form->field($model, 'file_spec')->widget(FileInput::classname(), [
                                        'options' => ['multiple' => false],
                                        'pluginOptions' => [
                                            'showUpload' => false
                                        ],
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    echo $form->field($model, 'file_breakeven')->widget(FileInput::classname(), [
                                        'options' => ['multiple' => false],
                                        'pluginOptions' => [
                                            'showUpload' => false
                                        ],
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    echo $form->field($model, 'file_etc')->widget(FileInput::classname(), [
                                        'options' => ['multiple' => false],
                                        'pluginOptions' => [
                                            'showUpload' => false
                                        ],
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </fieldset>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php #= $form->field($model, 'order_active')->dropDownList(['1' => 'ใช้งาน', '0' => 'ไม่ใช้งาน'])        ?>
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'บันทึกรายการ' : 'แก้ไขรายการ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
