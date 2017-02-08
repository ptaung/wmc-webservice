<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\webclient\components\Cwebclient;

$this->title = 'ข้อมูลประวัติการแพ้ยา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-group-index">
    <?php
    if (!\Yii::$app->user->can('super_admin')) {
        $sqlStringAdd = " and hoscode='{$dataselect}' ";
    }
    ?>

    <div class="">
        <?=
        GridView::widget([
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> ' . $this->title . '</h3>',
                'type' => 'default',
                'before' => '<div class="btn-group" role="group" aria-label="">'
                . '<form class="navbar-form navbar-left" method="GET" role="search" data-pjax="true">
  <div class="form-group">
    ' . Html::textInput('q_search', $_GET['q_search'], ['class' => 'form-control', 'placeholder' => 'ค้นหารายชื่อ-เลข 13 หลัก']) . '
    ' . /* Html::dropDownList('q_hospcode', $dataselect, \yii\helpers\ArrayHelper::map($data, 'hoscode', 'fullname'), ['class' => 'form-control input-sm', 'prompt' => ' ++เลือกสถานบริการ++']) */'' . '
  </div>
  <button type="submit" class="btn btn-success ">ตกลง</button>
</form>'
            ],
            #'beforeHeader' => [
            #[
            #'columns' => [
            # ['content' => 'ข้อมูลเด็ก', 'options' => ['colspan' => 5, 'class' => 'text-center warning']],
            # ['content' => 'วัคซีนเด็กอายุ 1 ปี', 'options' => ['colspan' => 5, 'class' => 'text-center success']],
            # ['content' => 'วัคซีนเด็กอายุ 2 ปี', 'options' => ['colspan' => 3, 'class' => 'text-center success']],
            # ['content' => 'วัคซีนเด็กอายุ 3 ปี', 'options' => ['colspan' => 2, 'class' => 'text-center success']],
            # ['content' => 'วัคซีนเด็กอายุ 5 ปี', 'options' => ['colspan' => 2, 'class' => 'text-center success']],
            #],
            #'options' => ['class' => 'skip-export'] // remove this row from export
            #]
            #],
            'export' => [
                'label' => 'ส่งออกรายงาน',
            ],
            'exportConfig' => [
                GridView::EXCEL => ['label' => 'บันทึกเป็น EXCEL'],
            #GridView::PDF => ['label' => 'บันทึกเป็น PDF'],
            ],
            'pjax' => true,
            'responsiveWrap' => false,
            'floatHeader' => true,
            #'export' => false,
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'เลขบัตรประชาชน',
                    'attribute' => 'cid',
                    'format' => 'raw',
                ],
                [
                    'label' => 'ชื่อ-สกุล',
                    'attribute' => 'patient_name',
                    'format' => 'raw',
                ],
                [
                    'label' => 'วันเกิด',
                    'attribute' => 'birthday',
                    'format' => 'text',
                    'value' => function($data) {
                        return Cwebclient::getThaiDate($data['birthday']);
                    }
                ],
                [
                    'label' => 'สถานบริการที่บันทึกข้อมูล',
                    'attribute' => 'hcode',
                    'format' => 'text',
                    'value' => function($data) {
                        return Cwebclient::getHoscode($data['hcode']);
                    }
                ],
                [
                    'label' => 'วันที่รายงานการแพ้ยา',
                    'attribute' => 'report_date',
                    'format' => 'text',
                    'value' => function($data) {
                        return Cwebclient::getThaiDate($data['report_date']);
                    }
                ],
                [
                    'label' => 'วันที่พบอาการแพ้ยา',
                    'attribute' => 'begin_date',
                    'format' => 'text',
                    'value' => function($data) {
                        return Cwebclient::getThaiDate($data['begin_date']);
                    }
                ],
                [
                    'label' => 'Agent',
                    'attribute' => 'agent',
                ],
                [
                    'label' => 'อาการ',
                    'attribute' => 'symptom',
                ],
            ],
        ]);
        ?>
        <?php #yii\widgets\Pjax::end()       ?>
    </div>
</div>
