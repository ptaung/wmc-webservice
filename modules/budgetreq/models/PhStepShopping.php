<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_step_shopping".
 *
 * @property integer $step_shopping_id
 * @property integer $items_id
 * @property string $hospcode
 * @property string $step_shopping_create
 * @property string $step_shopping_update
 * @property double $step_1
 * @property string $step_21
 * @property string $step_22
 * @property string $step_3
 * @property string $step_41
 * @property string $step_42
 * @property double $step_43
 * @property string $step_51
 * @property string $step_52
 * @property integer $step_slow
 * @property string $step_comment
 */
class PhStepShopping extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_step_shopping';
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
            [['step_shopping_create', 'step_shopping_update', 'step_21', 'step_22', 'step_41', 'step_51'], 'safe'],
            [['step_1', 'step_43'], 'number'],
            [['step_comment'], 'string'],
            [['hospcode'], 'string', 'max' => 5],
            [['step_3'], 'string', 'max' => 1],
            [['step_42'], 'string', 'max' => 200],
            [['step_52'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'step_shopping_id' => 'Step Shopping ID',
            'items_id' => 'รายการ',
            'hospcode' => 'หน่วยงาน',
            'step_shopping_create' => 'Step Shopping Create',
            'step_shopping_update' => 'Step Shopping Update',
            'step_1' => 'ราคากลาง',
            'step_21' => 'วันที่ลงนามเห็นชอบ',
            'step_22' => 'วันที่ประกาศ',
            'step_3' => 'เจ้าหน้าที่รับซอง',
            'step_41' => 'วันที่เปิดซอง',
            'step_42' => 'บริษัท',
            'step_43' => 'ราคาต่อหน่วย',
            'step_51' => 'วันที่ลงนามในสัญญา',
            'step_52' => 'เลขที่สัญญา',
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
