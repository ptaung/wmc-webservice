<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            #'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            #'fixedVerifyCode' => 'test',
            #'transparent' => true,
            #'minLength' => 3,
            #'maxLength' => 4
            ],
        ];
    }

    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
// change layout for error action
            if ($action->id == 'error')
                $this->layout = 'errorlayout';
            return true;
        } else {
            return false;
        }
    }

    public function actionIndex() {
        if (\Yii::$app->user->isGuest) {
            $this->redirect(['/user/login']);
        }
        return $this->render('index');
    }

    /*
      public function actionMap() {
      return $this->render('map');
      }

      public function actionLogin() {
      if (!\Yii::$app->user->isGuest) {
      return $this->goHome();
      }

      $model = new LoginForm();
      if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
      }
      return $this->render('login', [
      'model' => $model,
      ]);
      }

      public function actionLogout() {
      Yii::$app->user->logout();

      return $this->goHome();
      }


      public function actionContact() {
      $model = new ContactForm();
      if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
      Yii::$app->session->setFlash('contactFormSubmitted');

      return $this->refresh();
      }
      return $this->render('contact', [
      'model' => $model,
      ]);
      }

      public function actionAbout() {
      return $this->render('about');
      }
     */
}
