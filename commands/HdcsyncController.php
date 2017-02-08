<?php

namespace app\commands;

use yii\console\Controller;
use app\modules\webclient\controllers\ProcessController as Process;

class HdcsyncController extends Controller {

    public static function actionIndex() {
        echo 'Running>>>>>';
        Process::actionRun();
    }

}
