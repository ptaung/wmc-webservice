<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\assets\AppAsset;

$theme = AppAsset::register($this);

$this->title = $name;
?>
<div class="site-error">
    <div class="jumbotron">
        <h2><?php echo Yii::$app->params['systemName']; ?></h2>
        <hr>
        <center>
            <?php echo Html::img($theme->baseUrl . '/../themes/bootstrap4/assets/images/pc.png', [ 'alt' => 'ERROR PAGE', 'class' => 'img-responsive']); ?>
        </center>

        <h2><?= Html::encode($this->title) ?></h2>
        <p class="text-danger"><?= nl2br(Html::encode($message)) ?></p>
        <p>
            <?php echo Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-lg btn-success']); ?>
        </p>
    </div>

</div>
