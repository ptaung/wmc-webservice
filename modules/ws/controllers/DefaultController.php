<?php

namespace app\modules\ws\controllers;

use yii\web\Controller;

class DefaultController extends Controller {

    public function actionIndex() {
        echo date('Y-m-d');
        #return $this->render('index');
    }

}
