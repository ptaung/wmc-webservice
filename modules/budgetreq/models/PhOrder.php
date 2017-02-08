<?php

namespace app\modules\budgetreq\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "ph_order".
 *
 * @property string $order_id
 * @property integer $items_id
 * @property integer $request_id
 * @property string $hospcode
 * @property string $order_name
 * @property string $order_active
 * @property string $order_date
 * @property string $order_file_project
 * @property string $order_file_cost
 * @property string $order_file_spec
 * @property string $order_file_breakeven
 * @property string $order_file_etc
 * @property string $order_reason
 * @property integer $order_priority
 * @property integer $order_amount
 *
 * @property PhOperationRequest $operationRequest
 * @property PhHospcode $hospcode0
 * @property PhItems $phItems
 */
class PhOrder extends \yii\db\ActiveRecord {

    public $file_breakeven;
    public $file_project;
    public $file_cost;
    public $file_spec;
    public $file_etc;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_order';
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
            [['items_id', 'request_id', 'hospcode', 'reason_id'], 'required'],
            [['items_id', 'request_id', 'reason_id', 'order_priority', 'order_amount'], 'integer'],
            [['order_amount'], 'default', 'value' => 1],
            [['order_amount'], 'number', 'min' => 1],
            [['order_addon'], 'number'],
            [['order_date', 'order_priority', 'order_date_modify'], 'safe'],
            [['order_file_project', 'order_file_cost', 'order_file_spec', 'order_file_breakeven', 'order_file_etc', 'order_reason'], 'string'],
            [['order_reason_present', 'order_reason_conform', 'order_reason_carry', 'order_reason_benefit'], 'string'],
            [['hospcode'], 'string', 'max' => 5],
            [['order_active'], 'string', 'max' => 1],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhRequest::className(), 'targetAttribute' => ['request_id' => 'request_id']],
            [['hospcode'], 'exist', 'skipOnError' => true, 'targetClass' => PhHospcode::className(), 'targetAttribute' => ['hospcode' => 'hospcode']],
            [['items_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhItems::className(), 'targetAttribute' => ['items_id' => 'items_id']],
            [['reason_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhReason::className(), 'targetAttribute' => ['reason_id' => 'reason_id']],
            [['file_project', 'file_cost', 'file_spec', 'file_breakeven'], 'file', 'extensions' => ['pdf'], 'on' => 'update'],
            [['file_etc'], 'file', 'extensions' => ['pdf'], 'skipOnEmpty' => true],
            [['file_project'], 'file', 'extensions' => ['pdf']],
            #[['order_reason'], 'required', 'on' => 'update'],
            [['items_id', 'request_id', 'hospcode'], 'unique', 'targetAttribute' => ['items_id', 'request_id', 'hospcode']], //ไม่ให้ข้อมูลซ้ำกัน
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'order_id' => Yii::t('app', 'รหัส'),
            'items_id' => Yii::t('app', 'รายการ'),
            'reason_id' => Yii::t('app', 'ประเภทการขอและเหตุผล'),
            'request_id' => Yii::t('app', 'งบประมาณ'),
            'hospcode' => Yii::t('app', 'หน่วยงาน'),
            'order_name' => Yii::t('app', 'การดำเนินการ'),
            'order_active' => Yii::t('app', 'สถานะใช้งาน'),
            'order_date' => Yii::t('app', 'วันที่บันทึก'),
            'order_date_modify' => Yii::t('app', 'วันที่แก้ไขล่าสุด'),
            'order_file_project' => Yii::t('app', 'ไฟล์โครงการ'),
            'order_file_cost' => Yii::t('app', 'ไฟล์สืบราคา'),
            'order_file_spec' => Yii::t('app', 'ไฟล์สเปก'),
            'order_file_breakeven' => Yii::t('app', 'ไฟล์คุ้มทุน'),
            'order_file_etc' => Yii::t('app', 'ไฟล์อื่นๆ'),
            'order_reason' => Yii::t('app', 'เหตุผลอื่นๆ'),
            'order_reason_present' => Yii::t('app', 'สภาพปัจจุบันที่มีอยู่'),
            'order_reason_conform' => Yii::t('app', 'ความสอดคล้องกับ'),
            'order_reason_carry' => Yii::t('app', 'ข้อมูลประกอบ'),
            'order_reason_benefit' => Yii::t('app', 'ประโยชน์ที่คาดว่า'),
            'order_priority' => Yii::t('app', 'ลำดับความสำคัญ'),
            'order_amount' => Yii::t('app', 'จำนวนที่ต้องการ'),
            'order_addon' => Yii::t('app', 'เงินสมทบ'),
            'file_project' => Yii::t('app', 'ไฟล์โครงการ'),
            'file_cost' => Yii::t('app', 'ไฟล์สืบราคา'),
            'file_spec' => Yii::t('app', 'ไฟล์สเปก'),
            'file_breakeven' => Yii::t('app', 'ไฟล์คุ้มทุน'),
            'file_etc' => Yii::t('app', 'ไฟล์อื่นๆ'),
        ];
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
    public function getHosp() {
        return $this->hasOne(PhHospcode::className(), ['hospcode' => 'hospcode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems() {
        return $this->hasOne(PhItems::className(), ['items_id' => 'items_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReason() {
        return $this->hasOne(PhReason::className(), ['reason_id' => 'reason_id']);
    }

}
