<?php

use Yii;
use yii\helpers\Url;

#แสดงรายการค้นหารายงานในระบบ
$url = Url::to(['/webclient/default/listmenu']);
$url_clearcache = Url::to(['/silasoft/admin/clearcache']);
$url_hdcsync = Url::to(['/webclient/process/run']);

$script = <<<SKRIPT

$(function(){

    $("#searchReportbtn").click(function(){
        $("#searchKeyword").val($("#searchKey").val())
        var url="{$url}";
        //var dataSet={ q: $("#searchKeyword").val()};
            $.post(url,{ q: $("#searchKey").val()},function(data){
                $("#searchContent").html(data);
            });
    });

    $("#searchReport").click(function(){
        $("#searchContent").html('กำลังค้นหา...');
        var url="{$url}";
        //var dataSet={ q: $("#searchKeyword").val()};
        $.post(url,{ q: $("#searchKeyword").val()},function(data){
            $("#searchContent").html(data);
         });
    });

    $("#clearcache").click(function(){
           $.post("{$url_clearcache}",function(data){
               alert(data);
            });
     });

    $("#hdcsync").click(function(){
           $.post("{$url_hdcsync}",function(data){
               alert(data);
            });
     });
});



SKRIPT;

$this->registerJs($script);
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <?php
        if (!Yii::$app->user->isGuest) {
            ?>
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <?php
                    echo @yii\helpers\Html::img(Yii::$app->user->identity->profile->getAvatarUrl(160), ['class' => 'img-circle', 'alt' => Yii::$app->user->identity->profile->name,]);
                    ?>
                </div>
                <div class="pull-left info">
                    <p><?= Yii::$app->user->identity->profile->name ?></p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- search form -->
            <form action="" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" id="searchKey" class="form-control" placeholder="ค้นหารายงาน..."/>
                    <span class="input-group-btn">
                        <button type='button' id='searchReportbtn' class="btn btn-flat" data-toggle="modal" data-target="#gridSystemModal"><i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->

            <?php
        }
        ?>
        <?php
        $menuItems = [
            ['label' => 'Admin Menu', 'options' => ['class' => 'header']],
            ['label' => 'กลับหน้าหลัก', 'url' => ['/silasoft/admin', 'adminMode' => FALSE]],
            ['label' => 'จัดการทั่วไป', 'url' => ['#'],
                'encode' => false,
                'icon' => 'glyphicon glyphicon-cog',
                'visible' => (Yii::$app->user->can('MANAGE-USER') || Yii::$app->user->can('super_admin')),
                'items' => [
                    ['label' => 'จัดการสมาชิก', 'url' => ['/user/admin/index'], 'visible' => (Yii::$app->user->can('MANAGE-USER') || Yii::$app->user->can('super_admin'))],
                    ['label' => 'จัดการสิทธิ', 'url' => ['/admin/assignment'], 'visible' => Yii::$app->user->can('super_admin')],
                    ['label' => 'จัดการกลุ่มรายงาน', 'url' => ['/report/menugroup'], 'visible' => Yii::$app->user->can('super_admin')],
                    ['label' => 'จัดการายงาน', 'url' => ['/report/menuitems'], 'visible' => Yii::$app->user->can('super_admin')],
                    ['label' => 'จัดการข่าวประชาสัมพันธ์', 'url' => ['/news'], 'visible' => Yii::$app->user->can('super_admin')],
                ]
            ],
            ['label' => 'System Config', 'url' => ['#'],
                'active' => true,
                'icon' => 'glyphicon glyphicon-cog',
                'items' => [
                    ['label' => 'ตั้งค่าโปรแกรมหลัก', 'icon' => 'glyphicon glyphicon-cog', 'url' => ['/backuprestore'], 'visible' => Yii::$app->user->can('super_admin')],
                    ['label' => 'จัดการ SQL Procedure', 'icon' => 'glyphicon glyphicon-cog', 'url' => ['/silasoft/procedure'], 'visible' => Yii::$app->user->can('super_admin')],
                    ['label' => 'จัดการ SQL XAlert', 'icon' => 'glyphicon glyphicon-cog', 'url' => ['/silasoft/xalert'], 'visible' => Yii::$app->user->can('super_admin')],
                    ['label' => 'SQL process', 'icon' => 'glyphicon glyphicon-cog', 'url' => ['/silasoft/admin/processlist'], 'visible' => Yii::$app->user->can('super_admin')],
                    ['label' => 'จัดการหน่วยงาน', 'icon' => 'glyphicon glyphicon-cog', 'url' => ['/report/wdep'], 'visible' => Yii::$app->user->can('super_admin')],
                    ['label' => 'จัดการรายงาน', 'icon' => 'glyphicon glyphicon-cog', 'url' => ['/report/wuseitems'], 'visible' => Yii::$app->user->can('super_admin')],
                    ['label' => 'Backup ฐานข้อมูล', 'icon' => 'glyphicon glyphicon-cog', 'url' => ['/backuprestore'], 'visible' => Yii::$app->user->can('super_admin')],
                    ['label' => 'Clear YIIcache', 'icon' => 'glyphicon glyphicon-cog', 'url' => 'javascript:;', 'options' => ['id' => 'clearcache'], 'encode' => false, 'visible' => Yii::$app->user->can('super_admin')],
                    ['label' => 'HdcSync', 'icon' => 'glyphicon glyphicon-cog', 'url' => ['/webclient/process/index'], 'visible' => Yii::$app->user->can('super_admin')],
                    ['label' => 'DataLink System', 'icon' => 'glyphicon glyphicon-cog', 'url' => ['/wmcsync'], 'visible' => Yii::$app->user->can('super_admin')],
                ],
            ],
        ];
        if (Yii::$app->user->isGuest) {
            //$menuItems[] = ['label' => 'Signup', 'url' => ['/user/registration/register']];
            $menuItems[] = [ 'encode' => false, 'icon' => 'glyphicon glyphicon-log-in', 'label' => 'เข้าสู่ระบบ', 'url' => ['/user/security/login']];
        } else {
            $menuItems[] = [
                'encode' => false,
                'icon' => 'glyphicon glyphicon-user',
                'label' => 'แก้ไขข้อมูลส่วนตัว',
                'url' => ['#'],
                'items' => [
                    ['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post'], 'encode' => false,],
                    ['label' => 'แก้ไขข้อมูลส่วนตัว', 'url' => ['/user/settings/profile']],
                    ['label' => 'เปลี่ยนรหัสผ่าน', 'url' => ['/user/settings/account']],
                    '<li class="divider"></li>',
                ]
            ];
            $menuItems[] = [

                'icon' => 'glyphicon glyphicon-log-out',
                'label' => 'Logout',
                'url' => ['/user/security/logout'],
                'linkOptions' => ['data-method' => 'post'],
                'encode' => false,
            ];
        }
        echo dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            'linkTemplate' => '<a href="{url}" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{icon} {label} </a>', #<i class="fa fa-angle-left pull-right"></i>
            'items' => $menuItems,
        ]);
        ?>

    </section>

</aside>


