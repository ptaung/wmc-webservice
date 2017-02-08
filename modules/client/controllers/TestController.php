<?php

namespace app\modules\client\controllers;

#use yii\web\Controller;
#use app\modules\client\models\UploadForm;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class TestController extends ActiveController {

    public $modelClass = 'app\modules\report\models\WuseItems';

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

    public function actionIndex2() {
        $request = \Yii::$app->request;
        $post = \Yii::$app->request->post();
        $get = \Yii::$app->request->get();

        if (copy($_FILES['files']['tmp_name'], \Yii::getAlias('@app') . '\_backup\\' . $_FILES['files']['name'] . '_' . date('YmdHis') . '.pdf')) {
            // do stuff
        } else {
            echo 'upload error!';
        }

        echo '<pre>';
        print_r($post);
        echo '</pre>';
        echo '<pre>';
        print_r($_FILES);
        echo '</pre>';


        echo 'OK';
        if ($request->isGet) {
            echo ' the request method is GET ';
        }
        if ($request->isPost) {
            echo ' the request method is POST ';
        }
    }

    public function auth($username, $password) {
        //Authen form table
        return \app\models\User::findOne(['username' => $username]);
    }

}
