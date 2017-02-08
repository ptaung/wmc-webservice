<?php

namespace app\models;

use Yii;
use dektrium\user\models\User;
use dektrium\user\Finder;
use dektrium\user\helpers\Password;

class OauthUser extends User implements \OAuth2\Storage\UserCredentialsInterface {

    /**
     * Implemented for Oauth2 Interface
     */
    public static function findIdentityByAccessToken($token, $type = NULL) {
        /** @var \filsh\yii2\oauth2server\Module $module */
        $getServer = Yii::$app->getModule('oauth2')->getServer();
        #echo $token;
        $token = $getServer->getResourceController()->getToken();
        #print_r($token);
        #exit;
        #print_r(static::findIdentity(4));
        #exit;
        #return static::findIdentity(4);
        return !empty($token['user_id']) ? static::findIdentity($token['user_id']) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id]);
    }

    /**
     * Implemented for Oauth2 Interface
     */
    public function checkUserCredentials($username, $password) {

        $user = self::findByUsername($username);
        if (empty($user)) {
            return false;
        }

        return self::validatePassword($password, $user->password_hash);
    }

    /**
     * Implemented for Oauth2 Interface
     */
    public function getUserDetails($username) {
        $user = self::findByUsername($username);
        return ['user_id' => $user->getId()];
    }

    public static function findByUsername($username) {
        $f = \Yii::$container->get(Finder::className());
        return $f->findUserByUsername($username);
    }

    public function validatePassword($password, $password_hash) {
        return !Password::validate($password, $password_hash);
    }

}
