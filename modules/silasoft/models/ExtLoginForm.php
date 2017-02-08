<?php

namespace app\modules\silasoft\models;

use Yii;
use dektrium\user\models\LoginForm as BaseLoginForm;

/**
 * LoginForm is the model behind the login form.
 */
class ExtLoginForm extends BaseLoginForm {

    public $verifyCode;

    /** @inheritdoc */
    public function attributeLabels() {
        return [
            'login' => Yii::t('user', 'Login'),
            'password' => Yii::t('user', 'Password'),
            'verifyCode' => 'Verification Code',
        ];
    }

    /** @inheritdoc */
    public function rules() {
        return [
            'requiredFields' => [['login', 'password'], 'required'],
            'loginTrim' => ['login', 'trim'],
            'verifyCode' => ['verifyCode', 'captcha', 'captchaAction' => '/site/captcha', 'caseSensitive' => false],
        ];
    }

}
