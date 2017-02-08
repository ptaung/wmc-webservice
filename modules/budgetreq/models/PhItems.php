<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_items".
 *
 * @property integer $items_id
 * @property string $items_name
 * @property integer $items_order
 * @property string $items_active
 * @property integer $items_group_id
 * @property double $items_cost
 *
 * @property PhItemsGroup $itemsGroup
 * @property PhOrder[] $phOrders
 */
class PhItems extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_items';
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
            [['items_order', 'items_group_id'], 'integer'],
            [['items_group_id'], 'required'],
            [['items_cost'], 'number'],
            [['items_name'], 'string', 'max' => 255],
            [['items_active'], 'string', 'max' => 1],
            [['items_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhItemsGroup::className(), 'targetAttribute' => ['items_group_id' => 'items_group_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'items_id' => Yii::t('app', 'รหัส'),
            'items_name' => Yii::t('app', 'ชื่อรายการ'),
            'items_order' => Yii::t('app', 'เลขที่'),
            'items_active' => Yii::t('app', 'สถานะใช้งาน'),
            'items_group_id' => Yii::t('app', 'ประเภท'),
            'items_cost' => Yii::t('app', 'ราคาต่อหน่วย'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsGroup() {
        return $this->hasOne(PhItemsGroup::className(), ['items_group_id' => 'items_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhOrders() {
        return $this->hasMany(PhOrder::className(), ['items_id' => 'items_id']);
    }

}
