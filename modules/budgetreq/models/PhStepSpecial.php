<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_step_special".
 *
 * @property integer $step_special_id
 * @property integer $items_id
 * @property string $hospcode
 * @property string $step_special_create
 * @property string $step_special_update
 * @property string $step_11
 * @property string $step_12
 * @property double $step_131
 * @property string $step_132
 * @property string $step_2
 * @property string $step_31
 * @property string $step_321
 * @property integer $step_322
 * @property string $step_33
 * @property integer $step_411
 * @property string $step_412
 * @property string $step_42
 * @property string $step_43
 * @property string $step_5
 * @property string $step_61
 * @property string $step_621
 * @property string $step_622
 * @property double $step_623
 * @property integer $step_slow
 * @property string $step_comment
 */
class PhStepSpecial extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_step_special';
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
            [['items_id', 'hospcode'], 'required'],
            [['items_id', 'step_322', 'step_411', 'step_slow'], 'integer'],
            [['step_special_create', 'step_special_update', 'step_132', 'step_321', 'step_621'], 'safe'],
            [['step_131', 'step_623'], 'number'],
            [['step_comment'], 'string'],
            [['hospcode'], 'string', 'max' => 5],
            [['step_11', 'step_12', 'step_2', 'step_31', 'step_33', 'step_42', 'step_43', 'step_5', 'step_61'], 'string', 'max' => 1],
            [['step_412'], 'string', 'max' => 255],
            [['step_622'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'step_special_id' => 'Step Special ID',
            'items_id' => 'รายการ',
            'hospcode' => 'หน่วยงาน',
            'step_special_create' => 'Step Special Create',
            'step_special_update' => 'Step Special Update',
            'step_11' => 'แต่งตั้งคณะกรรมการกำหนดราคากลาง',
            'step_12' => 'คณะกรรมการจัดทำราคากลาง',
            'step_131' => 'ราคากลาง',
            'step_132' => 'วันที่ลงนาม',
            'step_2' => 'เสนอรายงานขอซื้อ/ขอจ้าง',
            'step_31' => 'ส่งเอกสารเชิญผู้ขาย/ผู้รับจ้าง',
            'step_321' => 'วันที่เสนอราคา',
            'step_322' => 'จำนวนบริษัทที่เสนอราคาได้',
            'step_33' => 'คณะกรรมการจัดซื้อพิจารณาเอกสาร/คัดเลือก/ต่อรอง',
            'step_411' => 'ราคาที่เสนอได้',
            'step_412' => 'บริษัทที่เสนอราคาได้',
            'step_42' => 'ขออนุมัติแบบรูปวงเงิน',
            'step_43' => 'ตรวจสอบเอกสาร',
            'step_5' => 'ขออนุมัติสั่งซื้อ/สั่งจ้าง',
            'step_61' => 'แจ้งผู้ขาย/ผู้รับจ้างมาลงนามใน 7 วันหลังรับเอกสาร',
            'step_621' => 'วันที่ลงนาม',
            'step_622' => 'เลขที่สัญญา',
            'step_623' => 'วงเงินที่ลงในสัญญา',
            'step_slow' => 'สาเหตุความล่าช้า',
            'step_comment' => 'สาเหตุความล่าช้าอื่นๆ',
        ];
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
    public function getHosp() {
        return $this->hasOne(PhHospcode::className(), ['hospcode' => 'hospcode']);
    }

}
