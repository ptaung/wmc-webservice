<?php

namespace app\commands;

use yii\console\Controller;
use app\modules\ws\controllers\ProcessController as Process;

class ProcessController extends Controller {

    public function actionIndex() {
        echo 'Running>>>>>';
        Process::actionRun();
    }

}
