<?php

use yii\helpers\Html;
use kartik\grid\GridView;
?>

<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        # ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'เมนู',
            'format' => 'raw',
            'value' => function($m) {
                return \yii\helpers\Html::a($m->menu_items_name, [($m->menu_items_url ? $m->menu_items_url : '/report/rpt'), 'items' => $m->menu_items_id]) . '<br><small>' . $m->menu_items_comment . '</small>';
            }
                ]
            #'menu_group_name',
            #'menu_group_active',
            #'menu_group_comment:ntext',
            ],
        ]);
        ?>
