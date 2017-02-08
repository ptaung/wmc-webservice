<?php

namespace app\modules\hdcsync;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'app\modules\hdcsync\controllers';

    public function init() {
        parent::init();
        \Yii::$app->user->enableSession = false;
        // custom initialization code goes here
    }

    /** @var array The rules to be used in URL management. */
    /*
      public $urlRules = [
      'news/<action:\w+>' => 'news/news/listnews<action>',
      'module/<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
      ];
     *
     */
}
