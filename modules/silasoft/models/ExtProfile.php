<?php

namespace app\modules\silasoft\models;

use dektrium\user\models\Profile as BaseProfile;

class ExtProfile extends BaseProfile {

    public function rules() {
        $rules = parent::rules();
        // add some rules
        $rules['hospcodeRequired'] = ['hospcode', 'required'];
        $rules['hospcodeLength'] = ['hospcode', 'string', 'max' => 5];
        $rules['lastloginLength'] = ['lastlogin', 'date', 'format' => 'yyyy-M-d H:m:s'];

        return $rules;
    }

    public function getChos() {
        return $this->hasOne(Chospital::className(), ['hoscode' => 'hospcode']);
    }

}
