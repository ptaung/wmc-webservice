<?php

namespace app\modules\webclient\models;

use Yii;

/**
 * This is the model class for table "menu_group".
 *
 * @property integer $menu_group_id
 * @property string $menu_group_name
 * @property string $menu_group_active
 * @property string $menu_group_comment
 */
class WuseGroupLocal extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wuse_group_local';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['menu_group_comment'], 'string'],
            [['menu_group_name', 'menu_group_submenu'], 'string', 'max' => 255],
            [['menu_group_active'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'menu_group_id' => Yii::t('app', 'รหัส'),
            'menu_group_name' => Yii::t('app', 'ชื่อกลุ่มเมนู'),
            'menu_group_submenu' => Yii::t('app', 'Submenu'),
            'menu_group_active' => Yii::t('app', 'สถานะการใช้งาน'),
            'menu_group_comment' => Yii::t('app', 'หมายเหตุ'),
        ];
    }

}
