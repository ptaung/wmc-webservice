<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_step_ebidding".
 *
 * @property integer $step_ebidding_id
 * @property integer $items_id
 * @property string $hospcode
 * @property string $step_ebidding_create
 * @property string $step_ebidding_update
 * @property string $step_11
 * @property double $step_121
 * @property string $step_122
 * @property string $step_13
 * @property string $step_14
 * @property string $step_15
 * @property string $step_211
 * @property string $step_212
 * @property string $step_22
 * @property string $step_31
 * @property integer $step_32
 * @property integer $step_331
 * @property string $step_332
 * @property string $step_34
 * @property string $step_35
 * @property string $step_41
 * @property string $step_42
 * @property string $step_51
 * @property string $step_521
 * @property string $step_522
 * @property double $step_523
 * @property integer $step_slow
 * @property string $step_comment
 */
class PhStepEbidding extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_step_ebidding';
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
            [['items_id', 'step_32', 'step_331', 'step_slow'], 'integer'],
            [['step_ebidding_create', 'step_ebidding_update', 'step_122', 'step_211', 'step_212', 'step_521'], 'safe'],
            [['step_121', 'step_523'], 'number'],
            [['step_comment'], 'string'],
            [['hospcode'], 'string', 'max' => 5],
            [['step_11', 'step_13', 'step_14', 'step_15', 'step_22', 'step_31', 'step_34', 'step_35', 'step_41', 'step_42', 'step_51'], 'string', 'max' => 1],
            [['step_332'], 'string', 'max' => 255],
            [['step_522'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'step_ebidding_id' => 'Step Ebidding ID',
            'items_id' => 'รายการ',
            'hospcode' => 'หน่วยงาน',
            'step_ebidding_create' => 'Step Ebidding Create',
            'step_ebidding_update' => 'Step Ebidding Update',
            'step_11' => 'แต่งตั้งคณะกรรมการกำหนดราคากลาง/คณะกรรมการพิจารณาจัดทำเอกสาร',
            'step_121' => 'ราคากลาง',
            'step_122' => 'วันที่ลงนาม',
            'step_13' => 'ทำเอกสารประกวดราคาเผยแพร่วิจารณ์',
            'step_14' => 'จัดทำรายงานขอซื้อขอจ้าง/แต่งตั้งคณะกรรมการพิจารณาผลการประกวดราคา',
            'step_15' => 'เสนอหัวหน้าส่วนราชการเห็นชอบเอกสารและลงนามประกาศเชิญชวน',
            'step_211' => 'วันที่สิ้นสุดเผยแพร่',
            'step_212' => 'วันที่เสนอราคา',
            'step_22' => 'ให้ผู้เสนอราคาจัดทำเอกสารไม่น้อยกว่า3วันทำการ',
            'step_31' => 'ผู้เสนอราคาเสนอราคาผ่านระบบอิเล็กทรอนิกส์',
            'step_32' => 'จำนวนบริษัทที่เสนอราคาได้',
            'step_331' => 'ราคาที่เสนอได้',
            'step_332' => 'บริษัทที่เสนอราคาได้',
            'step_34' => 'ขออนุมัติรูปแบบวงเงินและระยะเวลาก่อหนี้ผูกพันจากสำนักงบประมาณ/ครม.(แล้วแต่กรณี/ถ้ามี)',
            'step_35' => 'ตรวจสอบเอกสารจัดซื้อจัดจ้างกับกลุ่มคลัง/กลุ่มกฎหมาย',
            'step_41' => 'เสนอหัวหน้าส่วนราชการผู้มีอำนาจสั่งซื้อสั่งจ้าง',
            'step_42' => 'แจ้งผลการเสนอราคาให้ผู้เสนอราคาทราบ',
            'step_51' => 'ร่างเอกสารสัญญาแจ้งผู้เสนอราคาได้ทำเอกสารการทำสัญญา',
            'step_521' => 'วันที่ลงนามทำสัญญา',
            'step_522' => 'เลขที่สัญญา',
            'step_523' => 'วงเงินที่ลงในสัญญา',
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
