<?php
/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 *
 */

use yii\helpers\Html;
#use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\nav\NavX;
use app\modules\webclient\components\Cmenuclient;
#use app\modules\hdcservice\components\Cmenu as Cmhdc;
#use app\components\Cmenu as Cmserver;
use yii\bootstrap\Modal;

raoul2000\bootswatch\BootswatchAsset::$theme = Yii::$app->params['bootswatchTheme'];
AppAsset::register($this);
$url = yii\helpers\Url::to(['/webclient/default/listmenu']);
$script = <<<SKRIPT


$(function(){

    $("#searchReportbtn").click(function(){
        $("#searchKeyword").val($("#searchKey").val())
        var url="{$url}";
        //var dataSet={ q: $("#searchKeyword").val()};
            $.post(url,{ q: $("#searchKeyword").val()},function(data){
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
$this->theme->baseUrl = '@web/../themes/bootstrap4';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode(Yii::$app->params['systemName']) ?></title>
        <?php $this->head() ?>

        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme->baseUrl ?>/assets/css/materialize.css" />

    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([

                'brandLabel' => '<div style="position:relative;top:-12px;"><b>WMC | </b>' . Yii::$app->params['systemName'] . '<br><small>' . Yii::$app->params['depname'] . '</small></div>',
                'brandUrl' => Yii::$app->homeUrl,
                'renderInnerContainer' => false,
                'options' => [
                    'class' => 'nav navbar-inverse navbar-fixed-top', //navbar-fixed-top   navbar-inverse/default  navbar-fixed-top
                ],
            ]);
            $menuItems = [
                '<div  class="navbar-form navbar-right" style="width: 16em; margin: 0.7em 0.5em;">
   <div class="input-group">
       <input type="Search" placeholder="ค้นรายงาน" class="form-control input-sm" id="searchKey" />
       <div class="input-group-btn" id="searchReportbtn">
           <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#gridSystemModal"  >
           <span class="glyphicon glyphicon-search"></span>
           </button>
       </div>
   </div>
</div>',
                ['label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Online:' . \Yii::$app->userCounter->getOnline(), 'url' => ['#']],
                #['label' => 'ระบบแผนที่', 'visible' => !Yii::$app->user->isGuest, 'url' => ['/wmgis']],
                #['label' => 'แลกเปลี่ยนข้อมูล', 'visible' => !Yii::$app->user->isGuest, 'url' => ['#']],
                #['label' => '<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> ทะเบียนข้อมูล', 'visible' => !Yii::$app->user->isGuest, 'url' => ['#']],
                Cmenuclient::getMainMenu('ระบบรายงาน'),
                #Cmserver::getMainMenu('รายงาน SERVER'),
                ['label' => 'แลกเปลี่ยนข้อมูล', 'url' => ['#'], 'visible' => !Yii::$app->user->isGuest,
                    'items' => [
                        ['label' => 'EMR Systems', 'url' => ['/emr']],
                        '<li class="divider"></li>',
                        ['label' => 'ทะเบียนประเมิน CVD RISK กลุ่มป่วยเบาหวานความดัน', 'url' => ['//webclient/register/thaicvdrisk']],
                        '<li class="divider"></li>',
                        ['label' => 'รายชื่อกลุ่มเป้าหมายคัดกรองเบาหวาน', 'url' => ['/webclient/register/dmhtscreen', 'q_screentype' => 1]],
                        ['label' => 'รายชื่อกลุ่มเป้าหมายคัดกรองความดัน', 'url' => ['/webclient/register/dmhtscreen', 'q_screentype' => 2]],
                        ['label' => 'รายชื่อเป้าหมายเด็กอายุ 18|30 เดือน', 'url' => ['/webclient/register/childdev1830'], 'visible' => \Yii::$app->user->can('super_admin')],
                        #
                        #['label' => 'รายชื่อกลุ่มเป้าหมายคัดกรองมะเร็งเต้านม', 'url' => ['/webclient/register/dmhtscreen', 'q_screentype' => 2]],
                        #['label' => 'รายชื่อกลุ่มเป้าหมายคัดกรองมะเร็งปากมดลูก', 'url' => ['/webclient/register/dmhtscreen', 'q_screentype' => 2]],
                        ['label' => 'ข้อมูลประชากร', 'url' => ['//webclient/register/person']],
                        ['label' => 'ข้อมูลผู้พิการในพื้นที่รับผิดชอบ', 'url' => ['//webclient/register/deformed']],
                        ['label' => 'ข้อมูลหญิงตั้งครรภ์', 'url' => ['//webclient/register/anc']],
                        ['label' => 'ข้อมูลการได้รับวัคซีนเด็กของอายุ 0-5 ปี', 'url' => ['/webclient/register/epi']],
                        ['label' => 'ข้อมูลการแพ้ยา', 'url' => ['/webclient/register/allergy']],
                        '<li class="divider"></li>',
                        ['label' => 'รางานติดตามการรับส่งข้อมูล', 'url' => ['/wmservice/hospitalbasestatus/index_user'], 'visible' => !Yii::$app->user->isGuest],
                        ['label' => 'เว็บเซอร์วิส', 'url' => ['/webservice'], 'visible' => \Yii::$app->user->can('super_admin'),
                            'items' => [
                                ['label' => 'ติดตามการรับส่ง', 'url' => ['/wmservice/hospitalbasestatus']],
                                '<li class="divider"></li>',
                                ['label' => 'ระบบส่งข้อมูล', 'url' => ['/list']],
                                ['label' => 'จัดการหน่วยงาน', 'url' => ['/list']],
                                '<li class="divider"></li>',
                            ]
                        ],
                    ]
                ],
                ['label' => 'เว็บเซอร์วิส', 'url' => ['/webservice'],
                    'visible' => 0,
                    'items' => [
                        ['label' => 'ระบบติดตามหน่วยบริการ', 'url' => ['/list']],
                        '<li class="divider"></li>',
                        ['label' => 'ระบบส่งข้อมูล', 'url' => ['/list']],
                        ['label' => 'ระบบจัดการหน่วยงาน', 'url' => ['/list']],
                        '<li class="divider"></li>',
                    ]
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
                ['label' => '<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> จัดการระบบ', 'url' => ['#']
                    , 'visible' => !Yii::$app->user->isGuest && \Yii::$app->user->can('super_admin'),
                    'items' => [
                        ['label' => 'จัดการสมาชิก', 'url' => ['/user/admin/index'], 'visible' => \Yii::$app->user->can('super_admin')],
                        ['label' => 'จัดการระบบ', 'url' => ['/setting'], 'visible' => \Yii::$app->user->can('super_admin')],
                        #['label' => 'จัดการ WM-TRANFER', 'url' => ['/wmservice/hospitalbasestatus'], 'visible' => \Yii::$app->user->can('super_admin')],
                        ['label' => 'จัดการสิทธิ', 'url' => ['/admin'], 'visible' => \Yii::$app->user->can('super_admin')],
                        ['label' => 'จัดการกลุ่มรายงาน', 'url' => ['/report/menugroup']],
                        #['label' => 'จัดการายงาน', 'url' => ['/webclient/default/wmreport']],
                        ['label' => 'จัดการายงาน', 'url' => ['/report/menuitems']],
                        ['label' => 'จัดการข่าวประชาสัมพันธ์', 'url' => ['/news']],
                        ['label' => 'CLIENT SERVICE', 'url' => ['#'], 'items' => [
                                ['label' => 'จัดการหน่วยงาน', 'url' => ['/report/wdep']],
                                ['label' => 'จัดการรายงาน', 'url' => ['/report/wuseitems']],
                            ]
                        ],
                        #['label' => 'จัดการกลุ่มเมนู', 'url' => ['/webclient/wusegrouplocal']],
                        #'<li class="divider"></li>',
                        ['label' => 'Backup ฐานข้อมูล', 'url' => ['/backuprestore'], 'visible' => \Yii::$app->user->can('super_admin')],
                    ]
                ],
                    //['label' => 'ผู้พัฒนาระบบ', 'url' => ['/developer'],]
            ];
            if (Yii::$app->user->isGuest) {
                //$menuItems[] = ['label' => 'Signup', 'url' => ['/user/registration/register']];
                $menuItems[] = ['label' => '<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> เข้าสู่ระบบ', 'url' => ['/user/security/login']];
            } else {
                $menuItems[] = [
                    'label' => '<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> แก้ไขข้อมูลส่วนตัว',
                    'url' => ['#'],
                    'items' => [
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => ['/wmgis'], 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'get'],],
                        ['label' => 'แก้ไขข้อมูลส่วนตัว', 'url' => ['/user/settings/profile']],
                        ['label' => 'เปลี่ยนรหัสผ่าน', 'url' => ['/user/settings/account']],
                        '<li class="divider"></li>',
                    ]
                ];
                $menuItems[] = [
                    'label' => '<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout(' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'get'],
                ];
            }

            echo NavX::widget([
                'options' => ['class' => 'navbar-nav navbar-right '],
                'encodeLabels' => false,
                'items' => $menuItems,
            ]);

            NavBar::end();
            ?>
            <?php
            #material-simple
            #$this->theme->baseUrl = '../themes/material-simple';
            ?>
            <?php if ($this->context->id == 'site') { ?>
                <div class="bs-example" data-example-id="carousel-with-captions">
                    <div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-captions" data-slide-to="1" class=""></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">

                            <div class="item">
                                <img src="<?php echo $this->theme->baseUrl; ?>/assets/images/imgslide/baner2.jpg"  class="img-responsive center-block">
                                <div class="carousel-caption">
                                    <h2>WMDatacenter</h2>
                                    <p><?php echo Yii::$app->params['systemName'] ?></p>
                                </div>
                            </div>
                            <div class="item">
                                <img src="<?php echo $this->theme->baseUrl; ?>/assets/images/imgslide/baner1.jpg"  class="img-responsive center-block">
                                <div class="carousel-caption">
                                    <h2>HEALTH DATACENTER</h2>
                                    <p><?php echo Yii::$app->params['depname']; ?></p>
                                </div>
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-captions" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-captions" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="clearfix" style="height:25px;"></div>
            <?php } else { ?>
                <div class = "clearfix" style = "height:65px;"></div>
                <?php
            }
            ?>

            <!--
           <main class="" role="main">
               <section id="blog-intro" class="z-depth-1 article-intro" style="background-image:url('<?php echo $this->theme->baseUrl ?>/assets/images/post.jpg');"></section>
           </main>




            -->
            <div class="container-fluid">

                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <!--
                                <div style="position: absolute; z-index: 1; right:0px;top: 50px;" class="visible-lg-block visible-md-block " >
                                    <img src="<?= yii\helpers\Url::to(['/qrcode/gen', 'text' => base64_encode(Yii::$app->request->absoluteUrl)]) ?>" />
                                    <div class="small text-center">for mobile phone</div>
                                </div>
                -->
                <?= $content ?>

            </div>
        </div>

        <footer class="footer hidden">
            <div class="container">
                <p class="pull-left">&copy; <?php echo Yii::$app->params['systemName']; ?> <?= date('Y') ?></p>

                <p class="pull-right"><?= 'พัฒนาระบบโดย ' . Yii::$app->params['whoDev'] ?></p>
            </div>
        </footer>
        <?php
        Modal::begin([
            'id' => 'gridSystemModal',
            'header' => '<h4 class="modal-title">ค้นหารายงาน</h4>',
            'size' => 'modal-lg',
            'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
        ]);
        ?>

        <div  class="">
            <div class="input-group">
                <input type="Search" placeholder="ค้นรายงาน" class="form-control" id="searchKeyword" />
                <div class="input-group-btn">
                    <button class="btn btn-info" id="searchReport">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
        </div>
        <br>
        <div  class="" id="searchContent"></div>

        <?php
        Modal::end();
        ?>
        <?=
        linchpinstudios\backstretch\Backstrech::widget([
            // 'duration' => 2000,
            //  'fade' => 750,
            'clickEvent' => false,
            'images' => [
                ['image' => 'https://bristolcountyvet.com/wp-content/uploads/2013/10/curvy-bag-background.jpg'],
            ],
        ]);
        ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
