<?php

namespace app\modules\hdcservice\models;

use Yii;

/**
 * This is the model class for table "campur".
 *
 * @property string $ampurcode
 * @property string $ampurname
 * @property string $ampurcodefull
 * @property string $changwatcode
 * @property string $flag_status
 */
class Campur extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'campur';
    }

    public static function getDb() {
        return Yii::$app->get('db_hdc');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ampurcode', 'ampurcodefull', 'changwatcode'], 'required'],
            [['ampurcode', 'changwatcode'], 'string', 'max' => 2],
            [['ampurname'], 'string', 'max' => 255],
            [['ampurcodefull'], 'string', 'max' => 4],
            [['flag_status'], 'string', 'max' => 1],
        ];
    }

    public function Listdata() {
        return Campur::find()->where('changwatcode = 72')->all();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ampurcode' => Yii::t('app', 'Ampurcode'),
            'ampurname' => Yii::t('app', 'Ampurname'),
            'ampurcodefull' => Yii::t('app', 'Ampurcodefull'),
            'changwatcode' => Yii::t('app', 'Changwatcode'),
            'flag_status' => Yii::t('app', 'Flag Status'),
        ];
    }

}
