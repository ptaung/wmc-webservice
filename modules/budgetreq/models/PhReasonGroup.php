<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_reason_group".
 *
 * @property integer $reason_group_id
 * @property string $reason_group_name
 * @property string $reason_group_active
 *
 * @property PhReason[] $phReasons
 */
class PhReasonGroup extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_reason_group';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('phdb');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['reason_group_name'], 'required'],
            [['reason_group_name'], 'string', 'max' => 255],
            [['reason_group_active'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'reason_group_id' => Yii::t('app', 'รหัส'),
            'reason_group_name' => Yii::t('app', 'การดำเนินการ'),
            'reason_group_active' => Yii::t('app', 'สถานะใช้งาน'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhReasons() {
        return $this->hasMany(PhReason::className(), ['reason_group_id' => 'reason_group_id']);
    }

}
