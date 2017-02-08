<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_operation".
 *
 * @property integer $operation_id
 * @property string $operation_name
 * @property integer $operation_order
 * @property string $operation_active
 *
 * @property PhOperationRequest[] $phOperationRequests
 */
class PhOperation extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_operation';
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
            [['operation_order'], 'integer'],
            [['operation_name'], 'string', 'max' => 255],
            [['operation_active'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'operation_id' => Yii::t('app', 'รหัส'),
            'operation_name' => Yii::t('app', 'การดำเนินการ'),
            'operation_order' => Yii::t('app', 'ลำดับที่'),
            'operation_active' => Yii::t('app', 'สถานะใช้งาน'),
        ];
    }

    /*
     * Custom Fields
     */

    public function getFullname() {
        return "(" . $this->operation_id . ") | " . $this->operation_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhOperationRequests() {
        return $this->hasMany(PhOperationRequest::className(), ['operation_id' => 'operation_id']);
    }

}
