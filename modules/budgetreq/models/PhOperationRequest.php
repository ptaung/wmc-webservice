<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_operation_request".
 *
 * @property integer $operation_request_id
 * @property integer $operation_id
 * @property integer $request_id
 * @property string $request_center_detail
 * @property string $request_local_detail
 *
 * @property PhOperation $operation
 * @property PhRequest $request
 * @property PhOrder[] $phOrders
 */
class PhOperationRequest extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_operation_request';
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
            [['operation_id', 'request_id'], 'required'],
            [['operation_id', 'request_id'], 'integer'],
            [['request_center_detail', 'request_local_detail'], 'string'],
            [['operation_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhOperation::className(), 'targetAttribute' => ['operation_id' => 'operation_id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhRequest::className(), 'targetAttribute' => ['request_id' => 'request_id']],
            [['operation_id', 'request_id'], 'unique', 'targetAttribute' => ['operation_id', 'request_id']], //ไม่ให้ข้อมูลซ้ำกัน
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'operation_request_id' => Yii::t('app', 'รหัส'),
            'operation_id' => Yii::t('app', 'ชื่อขั้นตอน'),
            'request_id' => Yii::t('app', 'งบประมาณ'),
            'request_center_detail' => Yii::t('app', 'รายละเอียดขั้นตอนของส่วนกลาง'),
            'request_local_detail' => Yii::t('app', 'รายละเอียดขั้นตอนของพื้นที่'),
        ];
    }

    /*
     * Custom Fields
     */

    public function getFullname() {
        return "(" . $this->operation_id . ") | " . $this->operation->operation_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperation() {
        return $this->hasOne(PhOperation::className(), ['operation_id' => 'operation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest() {
        return $this->hasOne(PhRequest::className(), ['request_id' => 'request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOporder() {
        return $this->hasOne(PhOperationOrder::className(), ['operation_request_id' => 'operation_request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*
      public function getPhOrders() {
      return $this->hasMany(PhOrder::className(), ['request_id' => 'operation_request_id']);
      }
     *
     */
}
