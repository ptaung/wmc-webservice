<?php

namespace app\modules\report\models;

use Yii;

/**
 * This is the model class for table "ctambon".
 *
 * @property string $tamboncode
 * @property string $tambonname
 * @property string $tamboncodefull
 * @property string $ampurcode
 * @property string $changwatcode
 * @property string $flag_status
 */
class Ctambon extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ctambon';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['tamboncode', 'tamboncodefull', 'ampurcode', 'changwatcode'], 'required'],
            [['tamboncode', 'changwatcode'], 'string', 'max' => 2],
            [['tambonname'], 'string', 'max' => 255],
            [['tamboncodefull'], 'string', 'max' => 6],
            [['ampurcode'], 'string', 'max' => 4],
            [['flag_status'], 'string', 'max' => 1],
        ];
    }

    public function Listdata() {
        return Ctambon::find()->where('changwatcode = 72')->all();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'tamboncode' => Yii::t('app', 'Tamboncode'),
            'tambonname' => Yii::t('app', 'Tambonname'),
            'tamboncodefull' => Yii::t('app', 'Tamboncodefull'),
            'ampurcode' => Yii::t('app', 'Ampurcode'),
            'changwatcode' => Yii::t('app', 'Changwatcode'),
            'flag_status' => Yii::t('app', 'Flag Status'),
        ];
    }

}
