<?php

namespace app\modules\webservice\controllers;

use yii\rest\ActiveController;
#use app\modules\report\models\WuseItems;
use yii\filters\ContentNegotiator;
use yii\web\Response;
#use yii\db\ActiveRecord;
#use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use app\modules\silasoft\models\ExtUser as User;

class ReportController extends ActiveController {

    public $modelClass = 'app\modules\report\models\WuseItems';

    #public $serializer = [
    #'class' => 'yii\rest\Serializer',
    #'collectionEnvelope' => 'data',
    #];

    public function behaviors() {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth']
        ];

        $behaviors['bootstrap'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actionItems() {
        //รับค่าจาก Client
        $var = \Yii::$app->request->post();
        $data = [];
        if (isset($var['param'])) {
            $param = $var['param'];

            if (isset($param['search'])) {
                $sqlQuery_field = " ,menu_items.* ";
                $sqlQuery_search = " AND (menu_items.menu_items_name LIKE '%{$param['search']}%') AND menu_items_name NOT LIKE '%รายชื่อ%'";
            } else {
                $sqlQuery_field = '';
                $sqlQuery_search = '';
            }

            if (isset($param['item_gid'])) {
                $sqlQuery_group_id = " AND menu_items.menu_group_id = '{$param['item_gid']}'";
            } else {
                $sqlQuery_group_id = '';
            }

            if (isset($param['item_id']) && strlen($param['item_id']) == 8) {
                $sqlQuery_field = " ,menu_items.* ";
                $sqlQuery_where_item = " AND concat('R' , menu_items.menu_items_id ) = '{$param['item_id']}' ";
            } elseif (isset($param['item_id']) && strlen($param['item_id']) > 0) {
                $sqlQuery_field = " ,menu_items.* ";
                $sqlQuery_where_item = " AND menu_items.menu_items_id = '{$param['item_id']}' ";
            } else {
                $sqlQuery_field = ' ,menu_items.menu_items_name, menu_items_comment';
                $sqlQuery_where_item = '';
            }
            try {
                $sqlQuery = "SELECT concat('R' , menu_items.menu_items_id ) as items_id
                    ,if(menu_items_name LIKE '%รายชื่อ%','1','0') as individual
                    ,menu_group_name
                    ,menu_group.menu_group_id
                    ,menu_group.menu_group_submenu
                    ,TIMESTAMPDIFF(DAY,wuse_items.create_at,NOW()) as allnew
                    {$sqlQuery_field}
                    FROM wuse_items,menu_items,wdep,menu_group
                    WHERE wuse_items.menu_items_id = menu_items.menu_items_id
                    AND menu_group.menu_group_id = menu_items.menu_group_id
                    AND wdep.hoscode = wuse_items.hoscode
                        AND wdep.active = 1
                    AND wuse_items.hoscode = '{$param['hoscode']}'
                        {$sqlQuery_where_item}
                            {$sqlQuery_group_id}
                                {$sqlQuery_search}
                        AND menu_items_active = 1
                        AND menu_items_status > 1
                    ";

                $command = \Yii::$app->db->createCommand($sqlQuery);
                $data = $command->queryAll();
            } catch (\Exception $ex) {
                $data = [
                    'message' => $ex->getMessage(),
                    'code' => $ex->getCode(),
                ];
            }
        } else {
            $data = [
                'message' => 'param is not set',
                'code' => 500
            ];
        }
        $ref = [
            'data' => $data,
            'check' => $param
        ];

        return $ref;
    }

    public function auth($username, $password) {
        //$password = \dektrium\user\helpers\Password::hash($password);
        //Authen form table
        return User::findOne(['username' => $username]);
    }

}
