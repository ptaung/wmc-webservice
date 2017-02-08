<?php

namespace app\controllers;

class ApiController extends \yii\web\Controller {

    public function behaviors() {
        return [
            // performs authorization by token
            'tokenAuth' => [
                'class' => \conquer\oauth2\TokenAuth::className(),
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    /**
     * Returns username and email
     */
    public function actionIndex() {
        $user = \Yii::$app->user->identity;
        return [
            'username' => $user->username,
            'email' => $user->email,
        ];
    }

}
