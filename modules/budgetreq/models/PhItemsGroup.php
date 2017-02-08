<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_items_group".
 *
 * @property integer $items_group_id
 * @property string $items_group_name
 * @property integer $items_group_order
 * @property string $items_group_active
 * @property integer $items_mastergroup_id
 *
 * @property PhItems[] $phItems
 * @property PhItemsMastergroup $itemsMastergroup
 */
class PhItemsGroup extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_items_group';
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
            [['items_group_order', 'items_mastergroup_id'], 'integer'],
            [['items_mastergroup_id'], 'required'],
            [['items_group_name'], 'string', 'max' => 255],
            [['items_group_active'], 'string', 'max' => 1],
            [['items_mastergroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhItemsMastergroup::className(), 'targetAttribute' => ['items_mastergroup_id' => 'items_mastergroup_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'items_group_id' => Yii::t('app', 'รหัส'),
            'items_group_name' => Yii::t('app', 'ชื่อประเภทรายการ'),
            'items_group_order' => Yii::t('app', 'ลำดับที่'),
            'items_group_active' => Yii::t('app', 'สถานะใช้งาน'),
            'items_mastergroup_id' => Yii::t('app', 'ประเภทรายการ'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhItems() {
        return $this->hasMany(PhItems::className(), ['items_group_id' => 'items_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsMastergroup() {
        return $this->hasOne(PhItemsMastergroup::className(), ['items_mastergroup_id' => 'items_mastergroup_id']);
    }

}
