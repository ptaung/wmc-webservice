<?php

namespace app\modules\silasoft\controllers;

use yii\web\Controller;

/**
 * Default controller for the `silasoft` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {

        $user = \Yii::$app->user;
        echo '<pre>';
        #print_r($user);

        echo '</pre>';
        #return $this->render('index');
    }

}
