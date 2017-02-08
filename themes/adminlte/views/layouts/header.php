<?PHP

use yii\helpers\Html;

#แสดง xalert

$url = yii\helpers\Url::to(['/webclient/xalert/index']);
$url_link = yii\helpers\Url::to(['/webclient/xalert/reportdetail']);
$url_sync = yii\helpers\Url::to(['/wmcsync/default/getsyncstauts']);
$url_dlc = yii\helpers\Url::to(['/wmcsync/dlc/index']);

$script = <<<SKRIPT
  $(function(){
        $.getJSON('{$url}', function (data) {
            if (data.length > 0) {
                $('#xalert_count').html(data.length);
                $('#xalert_label').html(data.length);
                $.each(data, function (index) {
                    if (index < 20) {
                        $("#xalert_list").append(
                                '<li><a href="{$url_link}?id='+data[index].eid+'">' +
                                '<i class="glyphicon glyphicon-thumbs-down"></i><b class="text-danger"> ' + data[index].error + '</b> <br>' + data[index].wmc_xalert_title + '' +
                                '</a></li>'
                                );
                    }
                });
            }
        });

         $.getJSON('{$url_dlc}', function (data) {
            if (data.length > 0) {
                $('#dlc_count').html(data.length);
                $('#dlc_label').html(data.length);
                $.each(data, function (index) {
                    if (index < 20) {
                        $("#dlc_list").append(
                                '<li><a href="#">' +
                                '<i class="glyphicon glyphicon-thumbs-down"></i><b class="text-danger"> ' + data[index].cc + '</b> <br>' + data[index].operation + '' +
                                '</a></li>'
                                );
                    }
                });
            }
        });


        $.getJSON('{$url_sync}', function (data) {
        if(data.checksync == '0'){
            alert("หน่วยบริการของท่านยังไม่ Sync ข้อมูล  กรุณาตรวจสอบการส่งข้อมูลด้วยค่ะ");
         }
            $('#sync_online').html(data.online);
            $('#sync_online2').html(data.online);
            $('#sync_lastonline').html(data.lastonline);
            $('#sync_lastsync').html(data.lastsync);
            $('#sync_ip').html(data.ip);
        });

  });

SKRIPT;
if ($visible)
    $this->registerJs($script);
?>

<header class="main-header">

    <a href="<?= Yii::$app->homeUrl ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b><b><span style="color:#FFEB3B;">ST</span></b></span>
        <span class="logo-lg">
            <?= Html::img('@web/logo.png'); ?>
            <!-- <span class="glyphicon glyphicon-qrcode" aria-hidden="true">-->
               <!-- <img alt="" src="core/images/logoDropshop.png" style="width: 28px;"> -->
            <b>DataLink</b>
            <span style="color:#FFEB3B;"> <b>Center</b></span>
        </span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span style="font-size: 16px;">
                <?php
                if (!Yii::$app->user->isGuest) {
                    ?>
                    <span class="visible-lg-inline"></span>
                    <span><?= app\modules\webclient\components\Cwebclient::getHoscode(Yii::$app->user->identity->profile->hospcode) ?></span>
                <?php } else { ?>
                    <span><?= Yii::$app->params['depname'] ?></span>
                <?php } ?>
            </span>
        </a>
        <?php if (!Yii::$app->user->isGuest) { ?>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown notifications-menu  visible-md-inline visible-lg-inline">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-feed"></i>
                            <span class="label label-success" id="sync_online">...</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">สถานะการส่งข้อมูลเข้าสู่ระบบ</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu small" >
                                    <li><a>สถานะปัจจุบัน : <b><span id="sync_online2"></span></b></a></li>
                                    <li><a>เชื่อมต่อ IP : <b><span id="sync_ip"></span></b></a></li>
                                    <li><a>เชื่อมต่อล่าสุดเมื่อ : <b><span id="sync_lastonline"></span></b> ที่แล้ว</a></li>
                                    <li><a>ส่งข้อมูลล่าสุดเมื่อ : <b><span id="sync_lastsync"></span></b> ที่แล้ว</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown notifications-menu  visible-md-inline visible-lg-inline">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-windows"></i>
                            <span class="label label-danger" id="sync_online2">0</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">แจ้งเตือนข้อผิดพลาดของระบบ</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu small" id=""></ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <li class="dropdown notifications-menu  visible-md-inline visible-lg-inline">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning" id="xalert_label">0</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">คุณมี <span id="xalert_count">0</span> ข้อผิดพลาดในการบันทึกข้อมูล</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu small" id="xalert_list"></ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <li class="dropdown notifications-menu  visible-md-inline visible-lg-inline">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-server"></i>
                            <span class="label label-warning" id="dlc_label">0</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">คุณมีรายการ อสม.อิเล็กทรอนิกส์ <span id="dlc_count">0</span> รายการ </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu small" id="dlc_list"></ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>

                    <li class="dropdown user user-menu visible-md-inline visible-lg-inline">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?=
                            yii\helpers\Html::img(Yii::$app->user->identity->profile->getAvatarUrl(64), [
                                ' class' => 'user-image',
                                'alt' => Yii::$app->user->identity->profile->name,
                            ])
                            ?>
                            <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">

                                <?=
                                yii\helpers\Html::img(Yii::$app->user->identity->profile->getAvatarUrl(160), [
                                    'class' => 'img-circle',
                                    'alt' => Yii::$app->user->identity->profile->name,
                                ])
                                ?>
                                <p>
                                    <?= Yii::$app->user->identity->profile->name ?>
                                    <small><?= Yii::$app->user->identity->profile->hospcode ?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-6 text-center">
                                    <?=
                                    Html::a(
                                            'แก้ไขสถานบริการ', [ '/user/settings/profile'], [ 'class' => '']
                                    )
                                    ?>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <?=
                                    Html::a(
                                            'แก้ไขรหัสผ่าน', ['/user/settings/account'], [ 'class' => '']
                                    )
                                    ?>
                                </div>

                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?=
                                    Html::a(
                                            'แก้ไขข้อมูลส่วนตัว', ['/user/settings/profile'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                    )
                                    ?>
                                </div>
                                <div class="pull-right">
                                    <?=
                                    Html::a(
                                            'ออกจากระบบ', ['/user/logout'], ['data-method' => 'get', 'class' => 'btn btn-default btn-flat']
                                    )
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <!-- User Account: style can be found in dropdown.less -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>


                </ul>
            </div>
        <?php } ?>
    </nav>
</header>
