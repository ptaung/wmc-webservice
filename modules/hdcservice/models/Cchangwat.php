<?php

namespace app\modules\hdcservice\models;

use Yii;

/**
 * This is the model class for table "cchangwat".
 *
 * @property string $changwatcode
 * @property string $changwatname
 * @property string $zonecode
 */
class Cchangwat extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cchangwat';
    }

    public static function getDb() {
        return Yii::$app->get('db_hdc');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['changwatcode'], 'required'],
            [['changwatcode', 'zonecode'], 'string', 'max' => 2],
            [['changwatname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'changwatcode' => 'Changwatcode',
            'changwatname' => 'Changwatname',
            'zonecode' => 'Zonecode',
        ];
    }

    public static function getProvinceName($id) {
        if ($id != '') {
            $data = Cchangwat::find()
                    ->select('changwatname')
                    ->where('changwatcode="' . $id . '"')
                    ->all();
            foreach ($data as $v) {
                $changwatname = $v['changwatname'];
            }
        } else {
            $changwatname = '';
        }

        return $changwatname;
    }

}
