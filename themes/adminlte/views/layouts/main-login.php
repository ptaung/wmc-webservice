<?php
#use backend\assets\AppAsset;

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

#use app\assets\FontAsset;

/* @var $this \yii\web\View */
/* @var $content string */
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => \yii::getAlias('@web') . "/favicon.ico"]);

dmstr\web\AdminLteAsset::register($this);
#FontAsset::register($this);
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
                body, html {
                    height: 100%;
                    background-repeat:no-repeat;
                    //background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
                    background-image: url('<?= Yii::$app->params['backgroundUrl']; ?>');
                    position: relative;
                    margin-left: auto;
                    margin-right: auto;
                    background-size:cover;
                    background-position:center;
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

    <body class=" <?= isset(\Yii::$app->params['adminLteTheme']) && !empty(\Yii::$app->params['adminLteTheme']) ? \Yii::$app->params['adminLteTheme'] : 'skin-green' ?>">

        <?php $this->beginBody() ?>
        <?= $this->render('header.php', ['directoryAsset' => $directoryAsset]) ?>
        <?php
        Breadcrumbs::widget(
                [
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]
        )
        ?>
        <br><br><br><br><br>
        <?= $content ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
