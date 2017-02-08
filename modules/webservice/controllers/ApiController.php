<?php

namespace app\modules\webservice\controllers;

use yii\rest\ActiveController;
use app\modules\report\models\Chospital;
//Formato json
use yii\filters\ContentNegotiator;
use yii\web\Response;
//Banco de dados
use yii\db\ActiveRecord;
//Segurança
use yii\filters\auth\CompositeAuth;
//use yii\filters\auth\QueryParamAuth; ####################### <<<<<<<<<---- QUERYPARAMS TO HTTPBASICAUTH
use yii\filters\auth\HttpBasicAuth;
use app\models\User;

class ApiController extends ActiveController {

    public $modelClass = 'app\modules\report\models\Chospital';

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

    public function actionWm() {
        //รับค่าจาก Client
        $var = \Yii::$app->request->post();
        $data = [];
        if (isset($var['param'])) {
            $param = $var['param'];
            try {
                $data = new \yii\data\ActiveDataProvider([
                    'query' => Chospital::find()->where("provcode ='{$param['provcode']}'"),
                    'pagination' => FALSE
                ]);
                $data = $data->getModels();
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
        //$data = base64_encode(serialize($data));
        $ref = [
            'data' => $data,
            'dd' => 'query',
        ];
        #$path = realpath(\Yii::$app->basePath) . '/zip_tmp/';
        $file = fopen("tmp.txt", "w");
        fwrite($file, var_export($ref, true));


        return $ref;
    }

    public function auth($username, $password) {
        //$password = \dektrium\user\helpers\Password::hash($password);
        //Authen form table
        return \app\models\User::findOne(['username' => $username]);
    }

}
