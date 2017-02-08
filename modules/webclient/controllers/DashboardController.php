<?php

namespace app\modules\webclient\controllers;

use yii\web\Controller;
use app\modules\webclient\components\Cdata;
use app\modules\silasoft\models\ExtProfile;
use Yii;

class DashboardController extends Controller {

    public function init() {
        parent::init();

        if (!Yii::$app->user->isGuest) {
            // Code to Set the last seen time for the user. For eg,
            $user = ExtProfile::findOne(Yii::$app->user->id);
            $user->lastlogin = new \yii\db\Expression('NOW()');
            $user->save(false, ["lastlogin"]);
        }
    }

    public function actionIndex() {

        $level = Cdata::levelLookupType();
        if ($level == "HOS") {
            $render = "index_hos";
        } elseif ($level == "SSO") {
            $render = "index_sso";
        } elseif ($level == "SSJ") {
            $render = "index_ssj";
        } else {
            $render = "index";
        }

        return $this->render($render);
    }

}
