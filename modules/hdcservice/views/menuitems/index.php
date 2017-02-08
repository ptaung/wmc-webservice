<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use app\modules\report\models\MenuGroup;
use app\modules\report\models\MenuItems;
use app\models\User;

Icon::map($this);
Icon::map($this, Icon::OCT);
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการระบบรายงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-items-index">
    <?=
    GridView::widget([
        'panel' => [
            //'before' => '',
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-qrcode"></i> จัดการระบบรายงาน</h3>',
            'type' => 'default',
            'before' => '<div class="btn-group" role="group" aria-label="">' . Html::a('<i class="glyphicon glyphicon-plus"></i> สร้างใหม่', ['create'], ['class' => 'btn btn-success'])
            . Html::a('<i class="glyphicon glyphicon-refresh"></i> Refresh', ['index'], ['class' => 'btn btn-success']) . '</div>',
#'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        #'footer' => true
        ],
        #'options' => ['class' => 'small'],
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'pjax' => true,
        'responsiveWrap' => false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'floatHeader' => true,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['class' => 'success'],
            ],
            [
                'attribute' => 'menu_items_active',
                'filter' => Html::activeDropDownList($searchModel, 'menu_items_active', [1 => 'ใช้งาน', 0 => 'ไม่ใช้งาน'], ['class' => 'form-control', 'prompt' => '<< เลือกกลุ่มรายงาน >>']),
                'headerOptions' => ['class' => 'success'],
                'format' => 'raw',
                'value' => function($data) {
            if ($data['menu_items_active'] <> '' || $data['menu_items_active'] == 1)
                return Html::button('ใช้งาน', ['class' => 'btn btn-success btn-xs']);
            else
                return Html::button('ไม่ใช้งาน', ['class' => 'btn btn-default btn-xs']);
        }
            ],
            [
                'label' => 'สถานะ',
                'headerOptions' => ['class' => 'success'],
                'attribute' => 'menu_items_status',
                'format' => 'raw',
                'visible' => 0,
                'filter' => Html::activeDropDownList($searchModel, 'menu_items_status', MenuItems::getStatus(), ['class' => 'form-control', 'prompt' => '<< เลือกกลุ่มรายงาน >>']),
                'value' => function($model) {
            $status = MenuItems::getStatus();
            if ($model->menu_items_status == 2) {
                $c = 'btn btn-success btn-xs';
            } else if ($model->menu_items_status == 1) {
                $c = 'btn btn-warning btn-xs';
            } else {
                $c = 'btn btn-danger btn-xs';
            }
            return Html::button(@$status[$model->menu_items_status], ['class' => $c]);
        }
            ],
            [
                'label' => 'ชื่อกลุ่ม',
                'headerOptions' => ['class' => 'success'],
                'attribute' => 'menu_group_id',
                'filter' => Html::activeDropDownList($searchModel, 'menu_group_id', ArrayHelper::map(MenuGroup::find()->all(), 'menu_group_id', 'menu_group_name'), ['class' => 'form-control', 'prompt' => '<< เลือกกลุ่มรายงาน >>']),
                'value' => 'menuGroup.menu_group_name',
                'visible' => 0,
            #'group' => true,
            #'groupedRow' => true,
            ],
            [
                'attribute' => 'menu_items_id',
                'headerOptions' => ['class' => 'success'],
            ],
            [
                'label' => 'ชื่อรายงาน',
                'attribute' => 'menu_items_name',
                'headerOptions' => ['class' => 'success'],
                'format' => 'raw',
                'options' => [
                #'width' => '35%'
                ],
                'value' => function($data) {
            return Html::a($data['sysreport']['report_name'], ['update', 'id' => $data['menu_items_id']]) . '<br><small>ที่มา::' . $data['sysreport']['notice'] . '</small>';
        }
            ],
            [
                'attribute' => 'menu_items_url',
                'headerOptions' => ['class' => 'success'],
                'visible' => 0,
            ],
            [
                'attribute' => 'menu_items_datasource',
                'headerOptions' => ['class' => 'success'],
            ],
            [
                'attribute' => 'menu_items_create',
                'headerOptions' => ['class' => 'success'],
                'format' => 'date'
            ],
            [
                'attribute' => 'menu_items_update',
                'headerOptions' => ['class' => 'success'],
                'format' => 'date'
            ],
            [
                'label' => 'สร้างโดย',
                'headerOptions' => ['class' => 'success'],
                'attribute' => 'menu_items_user_create',
                'filter' => Html::activeDropDownList($searchModel, 'menu_items_user_create', ArrayHelper::map(User::find()->all(), 'id', 'profile.name'), ['class' => 'form-control', 'prompt' => '<< เลือก >>']),
                'value' => 'userCreate.profile.name',
                'visible' => 0,
            ],
            [
                'headerOptions' => ['class' => 'success'],
                'label' => 'แก้ไขโดย',
                'attribute' => 'menu_items_user_update',
                'filter' => Html::activeDropDownList($searchModel, 'menu_items_user_update', ArrayHelper::map(User::find()->all(), 'id', 'profile.name'), ['class' => 'form-control', 'prompt' => '<< เลือก >>']),
                'value' => 'userUpdate.profile.name',
                'visible' => 0,
            ],
            #'menu_items_comment:ntext',
            [
                'label' => 'SQL',
                'headerOptions' => ['class' => 'success'],
                'attribute' => 'menu_items_sqlquery',
                'format' => 'raw',
                'value' => function($data) {
            if ($data['menu_items_sqlquery'] <> '')
                return Html::button(Icon::show('code', ['class' => 'octicon'], Icon::OCT), ['class' => 'btn btn-primary btn-xs']);
            else
                return '';
        }
            ],
            [
                'headerOptions' => ['class' => 'success'],
                'label' => 'HD',
                'attribute' => 'menu_items_columns',
                'format' => 'raw',
                'value' => function($data) {
            if ($data['menu_items_columns'] <> '')
                return Html::button(Icon::show('list-unordered', ['class' => 'octicon'], Icon::OCT), ['class' => 'btn btn-warning btn-xs']);
            else
                return '';
        }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['class' => 'success'],
                'template' => '{delete}',
                'buttons' => [
                    //view button
                    'delete' => function ($url, $model) {
                        if (empty($model->menu_items_sqlquery)) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span> ลบ', $url, [
                                        'title' => Yii::t('app', 'delete'),
                                        'class' => 'btn btn-danger btn-xs',
                            ]);
                        } else {
                            return Html::button('<span class="glyphicon glyphicon-random"></span> Lock', ['btn btn-success btn-xs']);
                        }
                    },
                        ],
                    ],
                ],
            ]);
            ?>

</div>
