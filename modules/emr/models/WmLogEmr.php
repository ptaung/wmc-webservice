<?php

namespace app\modules\emr\models;

use Yii;

/**
 * This is the model class for table "wm_log_emr".
 *
 * @property integer $wm_log_emr_id
 * @property string $ip
 * @property string $access_time
 * @property string $user_name
 * @property string $access_cid
 */
class WmLogEmr extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wm_log_emr';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_datacenter');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['access_time'], 'safe'],
            [['ip'], 'string', 'max' => 50],
            [['user_name'], 'string', 'max' => 200],
            [['access_cid'], 'string', 'max' => 13],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'wm_log_emr_id' => 'Wm Log Emr ID',
            'ip' => 'Ip',
            'access_time' => 'Access Time',
            'user_name' => 'User Name',
            'access_cid' => 'Access Cid',
        ];
    }

}
