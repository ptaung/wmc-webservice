<?php

namespace app\modules\report\models;

use Yii;

/**
 * This is the model class for table "wdep".
 *
 * @property string $hoscode
 * @property string $active
 *
 * @property Chospital $hoscode0
 * @property WuseItems[] $wuseItems
 */
class Wdep extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wdep';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['hoscode'], 'required'],
            [['hoscode'], 'string', 'max' => 5],
            [['active'], 'string', 'max' => 1],
            [['hoscode'], 'exist', 'skipOnError' => true, 'targetClass' => Chospital::className(), 'targetAttribute' => ['hoscode' => 'hoscode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'hoscode' => 'Hoscode',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChos() {
        return $this->hasOne(Chospital::className(), ['hoscode' => 'hoscode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWuseItems() {
        return $this->hasMany(WuseItems::className(), ['hoscode' => 'hoscode']);
    }

}
