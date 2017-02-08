<?php

namespace app\modules\ws;

use yii\base\BootstrapInterface;
use yii\base\Module as BaseModule;

/**
 * ws module definition class
 */
class Module extends BaseModule {#implements BootstrapInterface {

    /**
     * @inheritdoc
     */

    public $controllerNamespace = 'app\modules\ws\controllers';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        \Yii::$app->user->enableSession = false;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    #public function bootstrap($app) {
    #   if ($app instanceof \yii\console\Application) {
    #      $this->controllerNamespace = 'app\modules\ws\commands';
    # }
    #}
}
