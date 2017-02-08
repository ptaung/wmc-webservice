<?php

use yii\helpers\Html;

#use app\assets\FontAsset;
#กำหนดการแสดงผลสำหรับสุพรรณบุรี
$visible = (Yii::$app->params['codebase'] <> '000561' ? true : false);

if (Yii::$app->user->isGuest) {
    echo $this->render('main-login', ['content' => $content, 'visible' => $visible]);
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => \yii::getAlias('@web') . "/favicon.ico"]);

    #FontAsset::register($this);
    dmstr\web\AdminLteAsset::register($this);
    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
        <head>
            <meta charset="<?= Yii::$app->charset ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <?= Html::csrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>
            <?php $this->head() ?>
            <?php if ($visible) { ?>
                <style>
                    .main-sidebar, .left-side {
                        //height: 100%;
                        background-repeat:no-repeat;
                        background-image: url('<?= Yii::$app->params['backgroundUrl']; ?>');
                        //position: relative;
                        //margin-left: auto;
                        //margin-right: auto;
                        background-size:cover;
                        //background-position:center;
                    }
                </style>
            <?php } ?>
            <link href="https://fonts.googleapis.com/css?family=Kanit|Prompt" rel="stylesheet">
            <style>
                * {
                    //font-family: 'Oswald', sans-serif;
                    font-family: 'Prompt', sans-serif;
                    font-family: 'Kanit', sans-serif;
                    //font-family: 'Sriracha';
                }
            </style>
        </head>
        <!-- <body class="hold-transition skin-blue sidebar-mini"> -->
        <body  class="hold-transition <?= isset(\Yii::$app->params['adminLteTheme']) && !empty(\Yii::$app->params['adminLteTheme']) ? \Yii::$app->params['adminLteTheme'] : 'skin-green' ?> sidebar-mini">
            <?php $this->beginBody() ?>
            <div class="wrapper">
                <?php echo $this->render('header', ['directoryAsset' => $directoryAsset, 'visible' => $visible]) ?>
                <?php echo $this->render(Yii::$app->session->get('adminMode') == TRUE ? 'left-admin' : 'left', ['directoryAsset' => $directoryAsset, 'visible' => $visible]) ?>
                <?php echo $this->render('content', ['content' => $content, 'directoryAsset' => $directoryAsset, 'visible' => $visible]) ?>
            </div>

            <?php
            yii\bootstrap\Modal::begin([
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
            yii\bootstrap\Modal::end();
            ?>

            <?php $this->endBody() ?>
        </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
