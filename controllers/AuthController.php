<?php

namespace app\controllers;

#use app\models\LoginForm;

use yii\helpers\ArrayHelper;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;

class AuthController extends \yii\web\Controller {

    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
                    'authenticator' => [
                        'class' => CompositeAuth::className(),
                        'authMethods' => [
                            ['class' => HttpBearerAuth::className()],
                            ['class' => QueryParamAuth::className(), 'tokenParam' => 'accessToken'],
                        ]
                    ],
                    'exceptionFilter' => [
                        'class' => ErrorToExceptionFilter::className()
                    ],
        ]);
    }

    public function actionIndex() {
        $module = Yii::$app->getModule('oauth2');
        $response = $module->getServer()->handleAuthorizeRequest(
                $module->getRequest(), $module->getResponse(), !Yii::$app->getUser()->getIsGuest(), Yii::$app->getUser()->getId()
        );
        $this->setResponse($response);
        #$response = $module->handleAuthorizeRequest(!Yii::$app->getUser()->getIsGuest(), Yii::$app->getUser()->getId());

        /** @var object $response \OAuth2\Response */
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;

        return $response->getParameters();
    }

    public function setResponse($response) {
        Yii::$app->response->setStatusCode($response->getStatusCode());
        $headers = Yii::$app->response->getHeaders();

        foreach ($response->getHttpHeaders() as $name => $value) {
            $headers->set($name, $value);
        }
    }

}
