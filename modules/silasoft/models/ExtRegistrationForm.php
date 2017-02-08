<?php

namespace app\modules\silasoft\models;

use app\modules\silasoft\models\ExtProfile;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use dektrium\user\models\User;

class ExtRegistrationForm extends BaseRegistrationForm {

    /**
     * Add a new field
     * @var string
     */
    public $hospcode;
    public $name;
    public $passwordconfirm;
    public $captcha;

    #public $status;

    /**
     * @inheritdoc
     */
    public function rules() {
        $rules = parent::rules();

        $rules['hospcodeRequired'] = ['hospcode', 'required'];

        $rules['passwordconfirmRequired'] = ['passwordconfirm', 'required'];
        $rules['passwordCompare'] = ['passwordconfirm', 'compare', 'compareAttribute' => 'password'];

        $rules['hospcodeLength'] = ['hospcode', 'string', 'max' => 5];

        $rules['nameRequired'] = ['name', 'required'];
        $rules['nameLength'] = ['name', 'string', 'max' => 255];

        $rules['captchaRequired'] = ['captcha', 'required'];
        $rules['captcha'] = ['captcha', 'captcha'];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        $labels = parent::attributeLabels();
        $labels['hospcode'] = \Yii::t('user', 'สถานบริการ');
        $labels['passwordconfirm'] = \Yii::t('user', 'ยืนยันรหัสผ่าน');
        $labels['name'] = \Yii::t('user', 'ชื่อ-สกุล(ภาษาไทย)');
        $labels['username'] = \Yii::t('user', 'Username(ชื่อผู้ใช้งาน)');
        $labels['password'] = \Yii::t('user', 'Password(รหัสผ่าน)');

        return $labels;
    }

    /**
     * @inheritdoc
     */
    public function loadAttributes(User $user) {
        // here is the magic happens
        $user->setAttributes([
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
        ]);
        /** @var Profile $profile */
        $profile = \Yii::createObject(ExtProfile::className());

        $profile->setAttributes([
            'hospcode' => $this->hospcode,
            'name' => $this->name,
        ]);

        $user->setProfile($profile);
    }

}
