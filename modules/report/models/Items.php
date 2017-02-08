<?php

/*
 * Model from WEBSERVICE
 *
 */

namespace app\modules\report\models;

class Items extends \yii\rest {

    public static function resourceName() {
        return 'api';
    }

    public function attributes() {
        return ['hoscode', 'hosname', 'hostype'];
    }

    public function rules() {
// return rules for attributes
    }

}
