<?php

use yii\helpers\Html;
use kartik\grid\GridView;
?>

<?php

#echo '<pre>';
#print_r($dataProvider);
#echo '</pre>';

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'export' => false,
    'columns' => [
        # ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'เมนู',
            'format' => 'raw',
            'value' => function($m) {
                return \yii\helpers\Html::a($m['menu_items_name'], ['/webclient/rpt', 'items' => $m['items_id']]) . '<br><small>' . $m['menu_items_comment'] . '</small>';
            }
                ]
            #'menu_group_name',
            #'menu_group_active',
            #'menu_group_comment:ntext',
            ],
        ]);
        ?>
