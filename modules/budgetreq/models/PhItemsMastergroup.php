<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_items_mastergroup".
 *
 * @property integer $items_mastergroup_id
 * @property string $items_mastergroup_name
 * @property integer $items_mastergroup_order
 * @property string $items_mastergroup_active
 *
 * @property PhItemsGroup[] $phItemsGroups
 */
class PhItemsMastergroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ph_items_mastergroup';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('phdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['items_mastergroup_order'], 'integer'],
            [['items_mastergroup_name'], 'string', 'max' => 255],
            [['items_mastergroup_active'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'items_mastergroup_id' => Yii::t('app', 'รหัส'),
            'items_mastergroup_name' => Yii::t('app', 'ชื่อประเภทรายการ'),
            'items_mastergroup_order' => Yii::t('app', 'ลำดับที่'),
            'items_mastergroup_active' => Yii::t('app', 'สถานะใช้งาน'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhItemsGroups()
    {
        return $this->hasMany(PhItemsGroup::className(), ['items_mastergroup_id' => 'items_mastergroup_id']);
    }
}
