<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->news_header;
$this->params['breadcrumbs'][] = ['label' => 'ข่าวประชาสัมพันธ์', 'url' => ['listnews']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?php echo $model->news_header; ?></h1>
    <small><?php echo $model->news_date; ?></small>
    <p>รายละเอียด</p>
    <div>
        <?php echo $model->news_detail; ?>
    </div>



</div>
