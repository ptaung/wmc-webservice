<?php

namespace app\modules\silasoft\components;

use mdm\admin\models\searchs\Assignment;

class CadminManager {

    public static function getAuthUser($userID = null) {
        #$auth = \Yii::$app->authManager->getPermissionsByUser($userID);
        $auth = \Yii::$app->authManager->getAssignments($userID);

        foreach ($auth as $role) {
            $au .= $role->roleName . ',';
        }

        return $au;
    }

}
