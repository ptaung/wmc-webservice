<?php

use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\nav\NavX;
use app\components\Cmenu;

raoul2000\bootswatch\BootswatchAsset::$theme = Yii::$app->params['bootswatchTheme'];
AppAsset::register($this);
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
    </head>
    <body>
<?php $this->beginBody() ?>
        <div class="wrap">
            <div class="container-fluid">
<?= $content ?>
            </div>
        </div>
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
