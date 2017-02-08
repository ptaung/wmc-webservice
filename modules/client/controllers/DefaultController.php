<?php

namespace app\modules\client\controllers;

use yii\web\Controller;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;
use app\modules\client\components\Rest;
use app\modules\client\models\UploadForm;
use Yii;
use yii\web\UploadedFile;
use linslin\yii2\curl;

class DefaultController extends Controller {

    /**
     * Yii action controller
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        /*
          #$link = 'http://127.0.0.1/yiiproject/web/index.php/webservice/report/items';
          #$link = 'http://127.0.0.1/yiiproject/web/index.php/client/test/index2';
          #$l = 'http://127.0.0.1/yiiproject/web/index.php/client/test/index2';
          //Init curl
          $curl = new curl\Curl();
          try {

          $n = \Yii::getAlias('@app') . '\_backup\yiiwm.zip';
          $cfile = curl_file_create($n, null, 'testpic'); // try adding
          $post = [
          'files' => $cfile
          #'appname' => 'Sila Klanklaeo'
          ];

          $response = $curl
          ->setOption(CURLOPT_POSTFIELDS, $post)
          ->setOption(CURLOPT_USERPWD, \Yii::$app->params['cusername'] . ":" . \Yii::$app->params['cpassword'])
          ->post($link);
          } catch (\Exception $exc) {
          echo $exc->getTraceAsString();
          }

          echo $response;
          echo '<pre>';
          print_r($curl->getInfo());
          echo '</pre>';

         */
        Rest::run();
#return $this->render('index');
        /*
          $model = new UploadForm();

          if (Yii::$app->request->isPost) {
          $model->imageFile = UploadedFile::getInstance($model, 'files');
          if ($model->upload()) {
          // file is uploaded successfully
          return;
          }
          }

          return $this->render('index', ['model' => $model]);
         *
         */
    }

}
