<?php

namespace app\modules\api;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'app\modules\api\controllers';

    public function init() {
        parent::init();

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
