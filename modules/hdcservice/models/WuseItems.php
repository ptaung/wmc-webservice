<?php

namespace app\modules\hdcservice\models;

use Yii;

/**
 * This is the model class for table "wuse_items".
 *
 * @property string $hoscode
 * @property string $menu_items_id
 * @property string $create_at
 * @property string $update_at
 *
 * @property Wdep $hoscode0
 */
class WuseItems extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wuse_items';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['hoscode', 'menu_items_id'], 'required'],
            [['menu_items_id'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['hoscode'], 'string', 'max' => 5],
            [['hoscode'], 'exist', 'skipOnError' => true, 'targetClass' => Wdep::className(), 'targetAttribute' => ['hoscode' => 'hoscode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'hoscode' => 'Hoscode',
            'menu_items_id' => 'Menu Items ID',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHoscode0() {
        return $this->hasOne(Wdep::className(), ['hoscode' => 'hoscode']);
    }

    public function getItems() {
        return $this->hasOne(MenuItems::className(), ['menu_items_id' => 'menu_items_id']);
    }

}
