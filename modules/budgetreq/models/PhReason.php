<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_reason".
 *
 * @property integer $reason_id
 * @property string $reason_name
 * @property string $reason_active
 * @property integer $reason_group_id
 *
 * @property PhOrder[] $phOrders
 * @property PhReasonGroup $reasonGroup
 */
class PhReason extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_reason';
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
            [['reason_group_id', 'reason_name'], 'required'],
            [['reason_group_id'], 'integer'],
            [['reason_name'], 'string', 'max' => 255],
            [['reason_active'], 'string', 'max' => 1],
            [['reason_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhReasonGroup::className(), 'targetAttribute' => ['reason_group_id' => 'reason_group_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'reason_id' => Yii::t('app', 'รหัส'),
            'reason_name' => Yii::t('app', 'การดำเนินการ'),
            'reason_active' => Yii::t('app', 'สถานะใช้งาน'),
            'reason_group_id' => Yii::t('app', 'ประเภท'),
        ];
    }

    /*
     * Custom Fields
     */

    public function getFullname() {
        return $this->reasonGroup->reason_group_name . " : " . $this->reason_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhOrders() {
        return $this->hasMany(PhOrder::className(), ['reason_id' => 'reason_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReasonGroup() {
        return $this->hasOne(PhReasonGroup::className(), ['reason_group_id' => 'reason_group_id']);
    }

}
