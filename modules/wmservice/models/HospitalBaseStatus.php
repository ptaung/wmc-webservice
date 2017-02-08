<?php

namespace app\modules\wmservice\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "hospital_base_status".
 *
 * @property string $hbs_hospital_id
 * @property string $hbs_time
 * @property string $hbs_ip
 * @property string $hbs_browser
 * @property string $hbs_info
 * @property string $hbs_secretkey
 * @property string $hbs_sync_start
 * @property string $hbs_sync_finish
 * @property string $hbs_status_process
 * @property string $hbs_error
 * @property double $hbs_upload_size
 * @property string $hbs_version
 * @property string $hbs_sync
 * @property string $hbs_update
 * @property string $hbs_command
 */
class HospitalBaseStatus extends \yii\db\ActiveRecord implements IdentityInterface {

    public static function findIdentity($id) {
        return static::findOne(['hbs_hospital_id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'hospital_base_status';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['hbs_hospital_id'], 'required'],
            [['hbs_time', 'hbs_sync_start', 'hbs_sync_finish'], 'safe'],
            [['hbs_upload_size'], 'number'],
            [['hbs_command'], 'string'],
            [['hbs_hospital_id'], 'string', 'max' => 6],
            [['hbs_ip'], 'string', 'max' => 50],
            [['hbs_browser', 'hbs_info', 'hbs_secretkey', 'hbs_error'], 'string', 'max' => 255],
            [['hbs_status_process'], 'string', 'max' => 10],
            [['hbs_version', 'hbs_sync', 'hbs_update'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'hbs_hospital_id' => 'รหัสสถานบริการ',
            'hbs_time' => 'เชื่อมต่อ',
            'hbs_ip' => 'Ip',
            'hbs_browser' => 'Browser',
            'hbs_info' => 'Info',
            'hbs_secretkey' => 'Secretkey',
            'hbs_sync_start' => 'Sync-Start',
            'hbs_sync_finish' => 'Sync-Finish',
            'hbs_status_process' => 'Process',
            'hbs_error' => 'Error',
            'hbs_upload_size' => 'Upload-Size',
            'hbs_version' => 'Version',
            'hbs_sync' => 'Sync',
            'hbs_update' => 'Update',
            'hbs_command' => 'Command',
        ];
    }

    public function getChos() {
        return $this->hasOne(Chospital::className(), ['hoscode' => 'hbs_hospital_id']);
    }

}
