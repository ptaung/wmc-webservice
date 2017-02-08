<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <div class="jumbotron">
        <h1><?= Html::encode($this->title) ?></h1>
        <p class="text-danger"><?= nl2br(Html::encode($message)) ?></p>
        <p><a class="btn btn-lg btn-success" href="#">คุณไม่ได้ไปต่อ !</a></p>
    </div>

</div>
