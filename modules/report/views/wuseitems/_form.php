<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use app\modules\report\models\MenuGroup;
use app\modules\report\models\MenuItems;

$urllink = yii\helpers\Url::to(['additems']);

$script = <<<SKRIPT
   $(function(){
       $("#btn-submit").click(function(){
        var keys = $('#grid_form').yiiGridView('getSelectedRows');
        var hoscode = $('#wuseitems-hoscode').val();
        $.ajax({
            type: 'POST',
            url: '{$urllink}',
            //dataType: 'json',
            data: {keylist: keys,hoscode:hoscode},
            success: function(data) {
                   alert('จำนวนรายการที่เพิ่มคือ ' + data);
                   $.pjax.reload({container: '#grid_form'});
            },
         });
        });
   });

SKRIPT;

$this->registerJs($script);
?>

<div class="wuse-items-form">

    <?php $form = ActiveForm::begin('', 'post', ['data-pjax' => true]); ?>

    <?= $form->field($model, 'hoscode')->textInput(['maxlength' => true]) ?>

    <?php #= $form->field($model, 'menu_items_id')->textInput(['maxlength' => true])   ?>

    <?php #= $form->field($model, 'create_at')->textInput()   ?>

    <?php #= $form->field($model, 'update_at')->textInput()   ?>

    <?php
    echo
    GridView::widget([

        'panel' => [
            //'before' => '',
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> จัดการระบบรายงาน</h3>',
            'type' => 'default',
            'before' => '<div class="btn-group" role="group" aria-label="">' . Html::a('<i class="glyphicon glyphicon-plus"></i> สร้างใหม่', ['create'], ['class' => 'btn btn-success'])
            . Html::a('<i class="glyphicon glyphicon-refresh"></i> Refresh', ['index'], ['class' => 'btn btn-success']) . '</div>',
        ],
        'export' => false,
        #'options' => ['class' => 'small'],
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'pjax' => true,
        'id' => 'grid_form',
        'responsiveWrap' => false,
        'dataProvider' => $dataProvider_rpt,
        //'filterModel' => $searchModel,
        'floatHeader' => true,
        'columns' => [
            ['class' => 'kartik\grid\CheckboxColumn'],
            'menu_items_id',
            'menu_items_name',
        ],
    ]);
    ?>

    <div class = "form-group">
        <?=
        Html::button($model->isNewRecord ? 'Create' : 'Update', [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'btn-submit'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
