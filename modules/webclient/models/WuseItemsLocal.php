<?php

namespace app\modules\webclient\models;

use Yii;

/**
 * This is the model class for table "wuse_items_local".
 *
 * @property string $report_id
 * @property string $create_at
 * @property string $update_at
 * @property integer $menu_group_id
 */
class WuseItemsLocal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wuse_items_local';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_id'], 'required'],
            [['create_at', 'update_at'], 'safe'],
            [['menu_group_id'], 'integer'],
            [['report_id'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'report_id' => 'Report ID',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'menu_group_id' => 'Menu Group ID',
        ];
    }
}
