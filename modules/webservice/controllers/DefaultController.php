<?php

namespace app\modules\webservice\controllers;

use yii\web\Controller;
use app\modules\report\models\Items;

class DefaultController extends Controller {

    public function actionIndex() {


        $model = Items::find();
        echo '<pre>';
        print_r($model);
        echo '</pre>';
    }

}
