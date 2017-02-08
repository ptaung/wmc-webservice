<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\icons\Icon;

#use kartik\editable\Editable;

Icon::map($this);
Icon::map($this, Icon::OCT);

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$script = <<<SKRIPT
//$(function () {
  //$('[data-toggle="tooltip"]').tooltip()
//});


    function updateProcess(e,url,step){

        //alert($(e).attr('title'));

        document.getElementById('modaldata').innerHTML = 'กำลังดำเนินการเรียกข้อมูล...';
        var dataSet={ step: step,url:url, email: $("input#email").val() }; // กำหนดชื่อและค่าที่ต้องการส่ง
        $.post(url,dataSet,function(data){
             $('#modaldata').html(data);
        });

        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(e).attr('value'));
            //dynamiclly set the header for the modal
            document.getElementById('modalHeaderTitle').innerHTML = '<h4>' + $(e).attr('title') + '</h4>';
        } else {
            //if modal isn't open; open it and load content
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(e).attr('value'));
            //dynamiclly set the header for the modal
            document.getElementById('modalHeaderTitle').innerHTML = '<h4>' + $(e).attr('title') + '</h4>';
        }
   }

 function submitform(){
                        var form = $('#ebieddingFormId');
                        var formData = form.serialize();
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: formData,
                            success: function (data) {
                                 alert('บันทึกรายการสำเร็จ');
                                 $.pjax.reload({container: '#gridviewId'});
                            },
                            error: function () {
                                alert('Something went wrong');
                            }
                        });

            }
SKRIPT;

$this->registerJs($script, yii\web\View::POS_BEGIN);

$this->title = 'ติดตามงบประมาณ';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
yii\bootstrap\Modal::begin([
    'header' => '<span id="modalHeaderTitle"></span>',
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
?>
<div id="modaldata"></div>
<?php
yii\bootstrap\Modal::end();
?>
<div class="ph-step-ebidding-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php #= Html::a('Create Ph Step Ebidding', ['create'], ['class' => 'btn btn-success'])  ?>
    </p>


    <?php Pjax::begin(); ?>


    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">รายการที่กำลังดำเนินการ</a></li>
            <li role="presentation"><a href="#complete" aria-controls="complete" role="tab" data-toggle="tab">รายการที่ดำเนินการเสร็จสิ้น</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <h3 class="panel-title">e-bidding</h3>
                ขั้นตอนที่ต้องดำเนินการให้ทันของครุภัณฑ์/สิ่งก่อสร้างปีเดียว : 5.2 จัดทำสัญญา<br>
                ขั้นตอนที่ต้องดำเนินการให้ทันของสิ่งก่อสร้างผูกพัน : 5.2 จัดทำสัญญา
                <?=
                $this->render('_gridview_ebidding', [
                    'dataProvider' => $dataEbidding,
                ])
                ?>

                <h3 class="panel-title">วิธีตกลงราคา</h3>
                ขั้นตอนที่ต้องดำเนินการให้ทันของครุภัณฑ์/สิ่งก่อสร้างปีเดียว : 4 การสั่งซื้อ/สั่งจ้าง<br>
                ขั้นตอนที่ต้องดำเนินการให้ทันของสิ่งก่อสร้างผูกพัน : 4 การสั่งซื้อ/สั่งจ้าง
                <?=
                $this->render('_gridview_shopping', [
                    'dataProvider' => $dataShopping,
                ])
                ?>
                <h3 class="panel-title">วิธีสอบราคา</h3>
                ขั้นตอนที่ต้องดำเนินการให้ทันของครุภัณฑ์/สิ่งก่อสร้างปีเดียว : 5 หัวหน้าส่วนราชการลงนาม วันที่ลงนามในสัญญา/เลขที่สัญญา<br>
                ขั้นตอนที่ต้องดำเนินการให้ทันของสิ่งก่อสร้างผูกพัน : 5 หัวหน้าส่วนราชการลงนาม วันที่ลงนามในสัญญา/เลขที่สัญญา
                <?=
                $this->render('_gridview_deal', [
                    'dataProvider' => $dataDeal,
                ])
                ?>
                <h3 class="panel-title">วิธีพิเศษ</h3>
                <?=
                $this->render('_gridview_special', [
                    'dataProvider' => $dataSpecial,
                ])
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="complete">
                <h3 class="panel-title">e-bidding</h3>
                ขั้นตอนที่ต้องดำเนินการให้ทันของครุภัณฑ์/สิ่งก่อสร้างปีเดียว : 5.2 จัดทำสัญญา<br>
                ขั้นตอนที่ต้องดำเนินการให้ทันของสิ่งก่อสร้างผูกพัน : 5.2 จัดทำสัญญา
                <?PHP
                echo
                $this->render('_gridview_ebidding_complete', [
                    'dataProvider' => $dataEbidding_complete,
                ])
                ?>

                <h3 class="panel-title">วิธีตกลงราคา</h3>
                ขั้นตอนที่ต้องดำเนินการให้ทันของครุภัณฑ์/สิ่งก่อสร้างปีเดียว : 4 การสั่งซื้อ/สั่งจ้าง<br>
                ขั้นตอนที่ต้องดำเนินการให้ทันของสิ่งก่อสร้างผูกพัน : 4 การสั่งซื้อ/สั่งจ้าง
                <?PHP
                echo
                $this->render('_gridview_shopping_complete', [
                    'dataProvider' => $dataShopping_complete,
                ])
                ?>
                <h3 class="panel-title">วิธีสอบราคา</h3>
                ขั้นตอนที่ต้องดำเนินการให้ทันของครุภัณฑ์/สิ่งก่อสร้างปีเดียว : 5 หัวหน้าส่วนราชการลงนาม วันที่ลงนามในสัญญา/เลขที่สัญญา<br>
                ขั้นตอนที่ต้องดำเนินการให้ทันของสิ่งก่อสร้างผูกพัน : 5 หัวหน้าส่วนราชการลงนาม วันที่ลงนามในสัญญา/เลขที่สัญญา
                <?PHP
                echo
                $this->render('_gridview_deal_complete', [
                    'dataProvider' => $dataDeal_complete,
                ])
                ?>
                <h3 class="panel-title">วิธีพิเศษ</h3>
                <?PHP
                echo
                $this->render('_gridview_special_complete', [
                    'dataProvider' => $dataSpecial_complete,
                ])
                ?>

            </div>
        </div>

    </div>




    <?php Pjax::end(); ?>
</div>
