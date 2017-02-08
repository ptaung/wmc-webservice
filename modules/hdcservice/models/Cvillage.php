<?php

namespace app\modules\hdcservice\models;

use Yii;

/**
 * This is the model class for table "cvillage".
 *
 * @property string $villagecode
 * @property string $villagename
 * @property string $villagecodefull
 * @property string $tamboncode
 * @property string $ampurcode
 * @property string $changwatcode
 * @property string $flag_status
 */
class Cvillage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cvillage';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_hdc');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['villagecode', 'villagecodefull', 'tamboncode', 'ampurcode', 'changwatcode'], 'required'],
            [['villagecode', 'changwatcode'], 'string', 'max' => 2],
            [['villagename'], 'string', 'max' => 255],
            [['villagecodefull'], 'string', 'max' => 8],
            [['tamboncode'], 'string', 'max' => 6],
            [['ampurcode'], 'string', 'max' => 4],
            [['flag_status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'villagecode' => 'Villagecode',
            'villagename' => 'Villagename',
            'villagecodefull' => 'Villagecodefull',
            'tamboncode' => 'Tamboncode',
            'ampurcode' => 'Ampurcode',
            'changwatcode' => 'Changwatcode',
            'flag_status' => 'Flag Status',
        ];
    }
}
