<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\silasoft\components;

#use Yii;
#use yii\db\Connection;#
#use yii\db\Query;
#use yii\base\InvalidConfigException;
#use yii\di\Instance;

class CustomDbSession extends \yii\web\DbSession {

    public $writeCallback = ['app\modules\silasoft\components\CustomDbSession', 'writeCustomFields'];

    public function writeCustomFields($session) {
        $this->db->createCommand()
                ->delete($this->sessionTable, '[[expire]]<:expire', [':expire' => time()])
                ->execute();
        try {
            $uid = (\Yii::$app->user->getIdentity(false) == null) ? null : \Yii::$app->user->getIdentity(false)->id;
            return [ 'user_id' => $uid, 'ip' => $_SERVER['REMOTE_ADDR']];
        } catch (Exception $excp) {
            # \Yii::info(print_r($excp), 'informazioni');
        }
    }

}
