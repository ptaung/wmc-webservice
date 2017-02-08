<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_operation_order".
 *
 * @property integer $operation_order_id
 * @property integer $operation_request_id
 * @property integer $order_id
 * @property string $operation_order_date
 *
 * @property PhOperationRequest $operationRequest
 * @property PhOrder $order
 */
class PhOperationOrder extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_operation_order';
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
            [['operation_order_date', 'operation_request_id', 'operation_order_number'], 'required'],
            [['operation_request_id', 'order_id'], 'integer'],
            [['operation_order_date', 'operation_order_number'], 'safe'],
            [['operation_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhOperationRequest::className(), 'targetAttribute' => ['operation_request_id' => 'operation_request_id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhOrder::className(), 'targetAttribute' => ['order_id' => 'order_id']],
            [['operation_request_id', 'order_id'], 'unique', 'targetAttribute' => ['operation_request_id', 'order_id']], //ไม่ให้ข้อมูลซ้ำกัน
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'operation_order_id' => Yii::t('app', 'รหัส'),
            'operation_request_id' => Yii::t('app', 'ถึงขั้นตอนที่'),
            'order_id' => Yii::t('app', 'รายการ'),
            'operation_order_date' => Yii::t('app', 'วันที่'),
            'operation_order_number' => Yii::t('app', 'เลขที่หนังสือ'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperationRequest() {
        return $this->hasOne(PhOperationRequest::className(), ['operation_request_id' => 'operation_request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder() {
        return $this->hasOne(PhOrder::className(), ['order_id' => 'order_id']);
    }

    public function customDataOper($id, $order_id) {
        $model = PhOperationOrder::find()->where(['operation_request_id' => $id, 'order_id' => $order_id])->one();
        ;
        return $model;
    }

}
