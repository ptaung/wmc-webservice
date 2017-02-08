<?php

use yii\helpers\Html;
#use yii\grid\GridView;
use kartik\grid\GridView;
use app\modules\report\models\MenuGroup;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'กลุ่ม Menu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-group-index">
    <?=
    GridView::widget([
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> จัดการกลุ่มรายงาน</h3>',
            'type' => 'default',
            'before' => '<div class="btn-group" role="group" aria-label="">' . Html::a('<i class="glyphicon glyphicon-plus"></i> สร้างใหม่', ['create'], ['class' => 'btn btn-success'])
            . Html::a('<i class="glyphicon glyphicon-refresh"></i> Refresh', ['index'], ['class' => 'btn btn-success']) . '</div>',
#'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        #'footer' => true
        ],
        'pjax' => true,
        'responsiveWrap' => false,
        'floatHeader' => true,
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'menu_group_submenu',
                'value' => function($model) {
                    if ($model->menu_group_submenu > 0) {
                        $data = MenuGroup::find()->where("menu_group_id = " . $model->menu_group_submenu)->one();
                        return $data['menu_group_name'];
                    } else {
                        return 'เมนูหลัก';
                    }
                },
            #'group' => true,
            #'groupedRow' => true,
            ],
            'menu_group_id',
            'menu_group_name',
            'menu_group_active',
            //'menu_group_submenu',
            'menu_group_comment:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
