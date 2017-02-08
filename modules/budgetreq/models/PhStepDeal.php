<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_step_deal".
 *
 * @property integer $step_deal_id
 * @property integer $items_id
 * @property string $hospcode
 * @property string $step_deal_create
 * @property string $step_deal_update
 * @property string $step_1
 * @property string $step_2
 * @property string $step_3
 * @property string $step_41
 * @property string $step_42
 * @property double $step_43
 * @property integer $step_slow
 * @property string $step_comment
 */
class PhStepDeal extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_step_deal';
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
            [['items_id', 'step_slow'], 'integer'],
            [['step_deal_create', 'step_deal_update', 'step_43'], 'safe'],
            [['step_41'], 'number'],
            [['step_comment'], 'string'],
            [['hospcode'], 'string', 'max' => 5],
            [['step_1', 'step_2', 'step_3'], 'string', 'max' => 1],
            [['step_42', 'step_44'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'step_deal_id' => 'Step Deal ID',
            'items_id' => 'รายการ',
            'hospcode' => 'หน่วยงาน',
            'step_deal_create' => 'Step Deal Create',
            'step_deal_update' => 'Step Deal Update',
            'step_1' => 'ติดต่อตกรงราคากับผู้ขาย/ผู้รับจ้าง',
            'step_2' => 'การจัดทำรายงานต่อหัวหน้าส่วนราชการเพื่อให้ความเห็นชอบ',
            'step_3' => 'การเสนอสั่งซื้อ/สั่งจ้าง',
            'step_43' => 'วันที่ลงนามสัญญา',
            'step_44' => 'เลขที่สัญญา',
            'step_41' => 'ราคาที่ดำเนินการได้',
            'step_42' => 'ชื่อบริษัท',
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
