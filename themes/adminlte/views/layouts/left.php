<?php

use Yii;

#แสดงรายการค้นหารายงานในระบบ
$url = yii\helpers\Url::to(['/webclient/default/listmenu']);
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
                    echo @yii\helpers\Html::img(Yii::$app->user->identity->profile->getAvatarUrl(160), ['class' => 'img-thumbnail', 'alt' => Yii::$app->user->identity->profile->name,]);
                    ?>
                </div>
                <div class="pull-left info">
                    <p><?= Yii::$app->user->identity->profile->name ?></p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Status:<b style="color: #FFEB3B">Online</b></a>
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
            #['label' => 'Menu Wmc', 'options' => ['class' => 'header']],
            app\modules\webclient\components\Cmenuclient::getMainMenu('ระบบรายงาน'),
            #Cmserver::getMainMenu('รายงาน SERVER'),
            ['label' => 'รายงานติดตาม PA', 'url' => ['/webclient/pa'], 'visible' => !Yii::$app->user->isGuest,
                'encode' => false,
                'visible' => \Yii::$app->user->can('super_admin'),
                'icon' => 'glyphicon glyphicon-transfer',
            ],
            ['label' => 'อสม อิเล็กทรอนิกส์', 'url' => ['#'], 'visible' => !Yii::$app->user->isGuest,
                'encode' => false,
                #'visible' => \Yii::$app->user->can('super_admin'),
                'icon' => 'glyphicon glyphicon-transfer',
                'items' => [
                    ['label' => 'ข้อมูลหญิงตั้งครรภ์', 'url' => ['/wmcsync/dlc/anc']],
                ]
            ],
            ['label' => 'แลกเปลี่ยนข้อมูล', 'url' => ['#'], 'visible' => !Yii::$app->user->isGuest,
                'encode' => false,
                #'visible' => \Yii::$app->user->can('super_admin'),
                'icon' => 'glyphicon glyphicon-transfer',
                'items' => [
                    ['label' => 'EMR Systems', 'url' => ['/emr'], 'visible' => !Yii::$app->user->isGuest],
                    '<li class = "divider"></li> ',
                    ['label' => 'ข้อมูลประชากร', 'url' => [ '//webclient/register/person'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'ข้อมูลผู้พิการในพื้นที่รับผิดชอบ', 'url' => ['//webclient/register/deformed'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'ข้อมูลหญิงตั้งครรภ์', 'url' => ['//webclient/register/anc']],
                    ['label' => 'ข้อมูลการได้รับวัคซีนเด็กของอายุ 0-5 ปี', 'url' => ['/webclient/register/epi']],
                    ['label' => 'ข้อมูลการแพ้ยา', 'url' => ['/webclient/register/allergy'], 'visible' => !Yii::$app->user->isGuest],
                    '<li class="divider"></li>',
                    ['label' => 'เว็บเซอร์วิส', 'url' => ['/webservice'],
                        'visible' => \Yii::$app->user->can('super_admin'),
                        'items' => [
                            ['label' => 'ติดตามการรับส่ง', 'url' => ['/wmservice/hospitalbasestatus'], 'visible' => \Yii::$app->user->can('super_admin')],
                            '<li class="divider"></li>',
                            ['label' => 'ระบบส่งข้อมูล', 'url' => ['/list']],
                            ['label' => 'จัดการหน่วยงาน', 'url' => ['/list']],
                            '<li class="divider"></li>',
                        ]
                    ],
                ]
            ],
            ['label' => 'รายชื่อกลุ่มเป้าหมาย HDC', 'url' => ['#'], 'visible' => !Yii::$app->user->isGuest,
                'encode' => false,
                'icon' => 'glyphicon glyphicon-transfer',
                'items' => [
                    #['label' => 'สรุปข้อมูล CVD RISK กลุ่มป่วย', 'url' => ['//webclient/register/thaicvdrisksummary']],
                    #['label' => 'ทะเบียน CVD RISK กลุ่มป่วย', 'url' => ['//webclient/register/thaicvdrisk']],
                    #['label' => 'ทะเบียน CVD RISK กลุ่มคัดกรอง', 'url' => ['//webclient/register/thaicvdriskscreen']],
                    #'<li class="divider"></li>',
                    ['label' => 'เป้าหมายคัดกรองมะเร็งปากมดลูกในสตรี', 'url' => ['/webclient/target/cervixscreen'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star',],
                    ['label' => 'เป้าหมายคัดกรองมะเร็งเต้านม', 'url' => ['/webclient/target/breastscreen'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star',],
                    ['label' => 'เป้าหมายคัดกรอง DM', 'url' => ['/webclient/target/targetdmscreen'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star',],
                    ['label' => 'เป้าหมายคัดกรอง HT', 'url' => ['/webclient/target/targethtscreen'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star',],
                    ['label' => 'เป้าหมายผู้ป่วย DMHT', 'url' => ['/webclient/target/targetdmht'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star',],
                    ['label' => 'เป้าหมายคัดกรอง CKD', 'url' => ['/webclient/target/targetckd'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star'],
                    #['label' => 'เป้าหมายคัดกรองเบาหวาน', 'url' => ['/webclient/register/dmhtscreen', 'q_screentype' => 1]],
                    #['label' => 'เป้าหมายคัดกรองความดัน', 'url' => ['/webclient/register/dmhtscreen', 'q_screentype' => 2]],
                    #'<li class="divider"></li>',
                    ['label' => 'เป้าหมายการฝากครรภ์ 5 ครั้ง', 'url' => ['/webclient/target/targetanc5'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star'],
                    ['label' => 'เป้าหมายดูแลหลังคลอด 3 ครั้ง', 'url' => ['/webclient/target/targetanc3'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star'],
                    #'<li class="divider"></li>',
                    ['label' => 'เป้าหมายเด็กอายุ 18|30 เดือน', 'url' => ['/webclient/register/childdev1830'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star'],
                    ['label' => 'เป้าหมายเด็กอายุครบ 1 ปี EPI', 'url' => ['/webclient/target/epi1'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star'],
                    ['label' => 'เป้าหมายเด็กอายุครบ 2 ปี EPI', 'url' => ['/webclient/target/epi2'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star'],
                    ['label' => 'เป้าหมายเด็กอายุครบ 3 ปี EPI', 'url' => ['/webclient/target/epi3'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star'],
                    ['label' => 'เป้าหมายเด็กอายุครบ 5 ปี EPI', 'url' => ['/webclient/target/epi5'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star'],
                    ['label' => 'เป้าหมายเด็กนักเรียน', 'url' => ['/webclient/target/targetstudent'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star'],
                    ['label' => 'เป้าคัดกรองพัฒนาการเด็ก', 'url' => ['/webclient/target/ppspecial'], 'visible' => $visible, 'icon' => 'glyphicon glyphicon-star'],
                ]
            ],
            ['label' => 'คุณภาพข้อมูล', 'url' => ['/webclient/xalert/report'],
                'visible' => !Yii::$app->user->isGuest,
                'icon' => 'glyphicon glyphicon-flash',
            ],
            ['label' => 'รายงาน', 'url' => ['/report'], 'visible' => 0,
                'items' => [
                    ['label' => 'ตรวจสอบข้อมูล', 'url' => ['#'],
                        'items' => [
                            ['label' => 'ตรวจสอบบัญชี 1', 'url' => ['#']],
                            ['label' => 'ตรวจสอบบัญชี 2', 'url' => ['#']],
                            ['label' => 'ตรวจสอบบัญชี 3', 'url' => ['#']],
                            ['label' => 'ตรวจสอบบัญชี 4', 'url' => ['#']],
                            ['label' => 'ตรวจสอบบัญชี 5', 'url' => ['#']],
                            ['label' => 'ตรวจสอบบัญชี 6', 'url' => ['#']],
                            '<li class="divider"></li>',
                        ]
                    ],
                    ['label' => 'รายงานตัวชี้วัด', 'url' => ['#']],
                    ['label' => 'รายงาน QOF', 'url' => ['#']],
                    ['label' => 'ผลงานการบันทึก', 'url' => ['#']],
                    ['label' => 'ข้อมูลผู้ป่วยนอก', 'url' => ['#']],
                    ['label' => 'ข้อมูลผู้ป่วยใน', 'url' => ['#']],
                    '<li class="divider"></li>',
                    ['label' => 'ข้อมูลการใช้ยา', 'url' => ['#']],
                    '<li class="divider"></li>',
                    ['label' => 'ระบาดวิทยา', 'url' => ['#']],
                ]
            ],
            ['label' => 'GIS Health', 'url' => ['#'], 'visible' => 0,
                'items' => [
                    ['label' => 'ประชากร', 'url' => ['/wmgis']],
                    ['label' => 'พิกัดสถานบริการ', 'url' => ['#']],
                    ['label' => 'เบาหวานความดัน', 'url' => ['#']],
                    ['label' => 'ระบาดวิทยา', 'url' => ['#']],
                    ['label' => 'การเกิดโรค', 'url' => ['#']],
                    '<li class="divider"></li>',
                ]
            ],
            ['label' => 'จัดการสมาชิก', 'icon' => 'glyphicon glyphicon-cog', 'url' => ['/user/admin/index'], 'visible' => (Yii::$app->user->can('MANAGE-USER') || Yii::$app->user->can('super_admin'))],
            ['label' => 'AdminMode', 'url' => ['/silasoft/admin', 'adminMode' => TRUE], 'icon' => 'glyphicon glyphicon-thumbs-up', 'visible' => Yii::$app->user->can('super_admin')]
        ];
        if (Yii::$app->user->isGuest) {
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
                'encode' => false,
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
