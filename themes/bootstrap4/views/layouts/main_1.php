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
                    'class' => 'nav navbar-inverse navbar-fixed-top', //navbar-fixed-top
                //'class' => 'nav nav-pills'
                ],
            ]);
            $menuItems = [
                ['label' => 'ข่าว(News)', 'url' => ['/news/default/listnews'],],
                ['label' => 'คำของบลงทุน', 'url' => ['/budgetreq'], 'visible' => 1,
                    'items' => [
                        ['label' => 'เพิ่มรายการ', 'url' => ['/budgetreq/order']],
                        ['label' => 'ปรับระดับขั้นตอน', 'url' => ['/budgetreq/operationorder']],
                        '<li class="divider"></li>',
                        ['label' => 'จัดการข้อมูลพื้น', 'url' => '#',
                            'items' => [
                                ['label' => 'คำของบประมาณ', 'url' => ['/budgetreq/request']],
                                ['label' => 'หน่วยบริการ', 'url' => ['/budgetreq/hospcode']],
                                ['label' => 'ประเภทรายการ', 'url' => ['/budgetreq/itemsgroup']],
                                ['label' => 'ประเภทหลัก', 'url' => ['/budgetreq/itemsmastergroup']],
                                ['label' => 'ประเภทงบประมาณ', 'url' => ['/budgetreq/budgettype']],
                                ['label' => 'คำของบประมาณ', 'url' => ['/budgetreq/request']],
                                ['label' => 'ปีงบประมาณ', 'url' => ['/budgetreq/budget']],
                                ['label' => 'รายการขั้นตอน', 'url' => ['/budgetreq/operation']],
                                ['label' => 'ขั้นตอนการดำเนินงาน', 'url' => ['/budgetreq/operationreq']],
                                ['label' => 'ครุภัณฑ์สิ่งก่อสร้าง', 'url' => ['/budgetreq/items']],
                                ['label' => 'ประเภทการขอ', 'url' => ['/budgetreq/reasongroup']],
                                ['label' => 'รายการขอ', 'url' => ['/budgetreq/reason']],
                            ]],
                        '<li class="divider"></li>',
                        ['label' => 'ติดตามงบลงทุน', 'url' => ['/budgetreq/budgettracker']],
                    ]
                ],
                ['label' => 'รายงาน', 'url' => ['/report'], 'visible' => 0,
                    'items' => [

                        '<li class="divider"></li>',
                        '<li class="divider"></li>',
                    ]
                ],
                ['label' => 'ตั้งค่าระบบ', 'url' => ['#'], 'visible' => !Yii::$app->user->isGuest,
                    'items' => [
                        ['label' => 'จัดการสมาชิก', 'url' => ['/user/admin/index'], 'visible' => \Yii::$app->user->can('super_admin')],
                        ['label' => 'จัดการสิทธิ', 'url' => ['/admin'], 'visible' => \Yii::$app->user->can('super_admin')],
                        ['label' => 'จัดการข่าวประชาสัมพันธ์', 'url' => ['/news']],
                        '<li class="divider"></li>',
                        ['label' => 'Backup ฐานข้อมูล', 'url' => ['/backuprestore'], 'visible' => \Yii::$app->user->can('super_admin')],
                    ]
                ],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'เข้าสู่ระบบ', 'url' => ['/user/security/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }


            echo NavX::widget([
                'options' => ['class' => 'navbar-nav navbar-right '],
                'encodeLabels' => false,
                'items' => $menuItems,
            ]);

            NavBar::end();
            ?>

            <main class="" role="main">
                <section id="blog-intro" class="z-depth-1 article-intro" style="background-image:url('<?php echo $this->theme->baseUrl ?>/assets/images/post.jpg?v=b2f76a195e');"></section>
            </main>

            <!--
                        <div class="clearfix" style="height:75px;"></div>
            -->
            <div class="container-fluid">

                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>

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
        <div  class="" id="searchContent">

        </div>
        <?php
        Modal::end();
        ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
