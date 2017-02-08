<?php

namespace app\modules\silasoft\models;

use Yii;

/**
 * This is the model class for table "session_frontend_user".
 *
 * @property string $id
 * @property integer $user_id
 * @property string $ip
 * @property integer $expire
 * @property resource $data
 */
class SessionWmUser extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wm_session_user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'ip'], 'required'],
            [['user_id', 'expire'], 'integer'],
            [['data'], 'string'],
            [['id'], 'string', 'max' => 80],
            [['ip'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'ip' => 'Ip',
            'expire' => 'Expire',
            'data' => 'Data',
        ];
    }

}

/*
CREATE TABLE `wm_session_user` (
    `id` CHAR(80) CHARACTER SET utf8 NOT NULL,
    `user_id` INT(11) DEFAULT NULL,
    `ip` VARCHAR(15) CHARACTER SET utf8 NOT NULL,
    `expire` INT(11) DEFAULT NULL,
    `data` LONGBLOB,
    PRIMARY KEY (`id`),
    KEY `expire` (`expire`)
    ) ENGINE=INNODB;
 *  */