<?php

namespace app\modules\ws\controllers;

#use app\modules\silasoft\models\ExtUser as user;
#use yii\data\ActiveDataProvider;
#use yii\rest\ActiveController;

use yii;
use yii\rest\Controller;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class ApiController extends Controller {

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                ['class' => HttpBearerAuth::className()],
                ['class' => QueryParamAuth::className(),
                    'tokenParam' => 'accessToken'
                ],
            ],
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        return $behaviors;
    }

    public function actionIndex() {

        #$uploaddir = '/var/www/uploads/';
        #$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        #$data = Yii::$app->request->get();
        $request = Yii::$app->request;
        $m = '';
        if ($request->isAjax) {
            $m = 'ajax';
            $data = Yii::$app->request->ajax();
        }
        if ($request->isGet) {
            $m = 'GET';
            $data = Yii::$app->request->get();
        }
        if ($request->isPost) {
            $m = 'POST ';
            $data = Yii::$app->request->post();
        }
        if ($request->isPut) {
            $m = 'PUT ';
            $data = Yii::$app->request->put();
        }
        /*
          if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
          echo "File is valid, and was successfully uploaded.\n";
          } else {
          echo "Possible file upload attack!\n";
          }
         *
         */

        return [$m, $data, Yii::$app->request->userIP, $_FILES];
    }

}
