<?php

use Yii;
use yii\helpers\Url;

#แสดงรายการค้นหารายงานในระบบ
$url = Url::to(['/webclient/process/']);

$script = <<<SKRIPT

$(function(){
    $("#id_0").click(function(){
           $("#id_html_0").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
           $.post("{$url}/stable",function(data){
               alert(data);
               $("#id_html_0").html('');
           });
     });
    $("#id_1").click(function(){
           $("#id_html_1").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
           $.post("{$url}/tdmht",function(data){
               alert(data);
               $("#id_html_1").html('');
            });
     });
     $("#id_2").click(function(){
           $("#id_html_2").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
           $.post("{$url}/tchronic",function(data){
               alert(data);
               $("#id_html_2").html('');
           });
     });
     $("#id_3").click(function(){
           $("#id_html_3").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
           $.post("{$url}/tpersonanc",function(data){
               alert(data);
               $("#id_html_3").html('');
           });
     });
     $("#id_4").click(function(){
           $("#id_html_4").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
           $.post("{$url}/tpersonepi",function(data){
               alert(data);
               $("#id_html_4").html('');
           });
     });
     $("#id_5").click(function(){
           $("#id_html_5").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
           $.post("{$url}/chronicfu",function(data){
               alert(data);
               $("#id_html_5").html('');
           });
     });
     $("#id_6").click(function(){
           $("#id_html_6").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
           $.post("{$url}/labfu",function(data){
               alert(data);
               $("#id_html_6").html('');
           });
     });
     $("#id_7").click(function(){
           $("#id_html_7").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
           $.post("{$url}/postnatal",function(data){
               alert(data);
               $("#id_html_7").html('');
           });
     });
     $("#id_8").click(function(){
           $("#id_html_8").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
           $.post("{$url}/labor",function(data){
               alert(data);
               $("#id_html_8").html('');
           });
     });
});



SKRIPT;

$this->registerJs($script);
?>

<div class="site-index">

    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary container">
                <div class="box-header with-border">
                    <b><i class="fa fa-fw fa-question-circle text-blue"></i>
                        HDCSync เชื่อมโยงระบบฐานข้อมูล HDC เพื่อรับข้อมูล</b>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul>
                                <li><a href="javascript:;" id="id_1">ทะเบียน T_DMHT</a> <span id="id_html_1"></span></li>
                                <li><a href="javascript:;" id="id_2" >ทะเบียน T_CHRONIC</a> <span id="id_html_2"></span></li>
                                <li><a href="javascript:;" id="id_3" >ทะเบียน T_PERSON_ANC</a> <span id="id_html_3"></span></li>
                                <li><a href="javascript:;" id="id_4" >ทะเบียน T_PERSON_EPI</a> <span id="id_html_4"></span></li>
                                <li><a href="javascript:;" id="id_5" >ทะเบียน ChronicFU</a> <span id="id_html_5"></span></li>
                                <li><a href="javascript:;" id="id_6" >ทะเบียน LabFU</a> <span id="id_html_6"></span></li>
                                <li><a href="javascript:;" id="id_7" >ทะเบียน Postnatal</a> <span id="id_html_7"></span></li>
                                <li><a href="javascript:;" id="id_8" >ทะเบียน Labor</a> <span id="id_html_8"></span></li>
                                <li><a href="javascript:;" id="id_0" >ตาราง S-Table</a> <span id="id_html_0"></span></li>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
