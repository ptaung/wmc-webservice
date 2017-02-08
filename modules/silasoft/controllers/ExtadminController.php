<?php

/*
 * Modified by silasoft
 *
 */

namespace app\modules\silasoft\controllers;

use Yii;
use dektrium\user\controllers\AdminController as BaseAdmin;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use dektrium\user\filters\AccessRule;
use yii\helpers\Url;
#use dektrium\user\models\UserSearch;
use app\modules\silasoft\models\ExtUserSearch as UserSearch;

class ExtadminController extends BaseAdmin {

    /** @inheritdoc */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'confirm' => ['post'],
                    'block' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        #อนุญาตให้ admin จังหวัดและอำเภอเข้าจัดการผู้ใช้งานภายในอำเภอตัวเอง
                        'allow' => (Yii::$app->user->can('MANAGE-USER') || Yii::$app->user->can('super_admin')),
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        Url::remember('', 'actions-redirect');
        $searchModel = Yii::createObject(UserSearch::className());
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    #ให้สิทธิ user ใน WMC

    public function actionAssignuser($id) {
        #Url::remember('', 'actions-redirect');
        $query = "INSERT IGNORE INTO wm_auth_assignment SELECT 'USER' AS item ,'" . $id . "' AS id,CURRENT_TIMESTAMP AS tt";
        try {
            Yii::$app->db->createCommand($query)->execute();
            #Yii::$app->getSession()->setFlash('success', 'ยื่นยันการให้สิทธิใช้งาน เรียบร้อย');
            return $this->redirect(Url::previous('actions-redirect'));
        } catch (\Exception $exc) {
            #Yii::$app->getSession()->setFlash('danger', $exc->getMessage());
            return $this->redirect(Url::previous('actions-redirect'));
        }
    }

}
