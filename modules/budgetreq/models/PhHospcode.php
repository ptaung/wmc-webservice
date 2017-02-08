<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_hospcode".
 *
 * @property string $hospcode
 * @property string $hospcode_name
 * @property string $hospcode_active
 *
 * @property PhOrder[] $phOrders
 */
class PhHospcode extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_hospcode';
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
            [['hospcode'], 'required'],
            [['hospcode'], 'string', 'max' => 5],
            [['hospcode_name'], 'string', 'max' => 255],
            [['hospcode_active'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'hospcode' => Yii::t('app', 'รหัส'),
            'hospcode_name' => Yii::t('app', 'หน่วยบริการ'),
            'hospcode_active' => Yii::t('app', 'สถานะใช้งาน'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhOrders() {
        return $this->hasMany(PhOrder::className(), ['hospcode' => 'hospcode']);
    }

}
