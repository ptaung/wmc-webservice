<?php

namespace app\modules\silasoft\models;

use dektrium\user\models\User as BaseUser;

class ExtUser extends BaseUser {

    public $hospcode;

    public function scenarios() {
        $scenarios = parent::scenarios();
        // add field to scenarios
        $scenarios['create'][] = 'hospcode';
        $scenarios['update'][] = 'hospcode';
        $scenarios['register'][] = 'hospcode';
        return $scenarios;
    }

    public function rules() {
        $rules = parent::rules();
        // add some rules
        $rules['hospcodeRequired'] = ['hospcode', 'required'];
        $rules['hospcodeLength'] = ['hospcode', 'string', 'max' => 5];

        return $rules;
    }

}
