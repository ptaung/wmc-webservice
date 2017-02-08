<?php

namespace app\modules\hdcservice\models;

use Yii;

/**
 * This is the model class for table "czone".
 *
 * @property integer $zoneid
 * @property string $zonecode
 * @property string $zonename
 */
class Czone extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'czone';
    }

    public static function getDb() {
        return Yii::$app->get('db_hdc');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['zoneid', 'zonecode'], 'required'],
            [['zoneid'], 'integer'],
            [['zonecode'], 'string', 'max' => 2],
            [['zonename'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'zoneid' => Yii::t('app', 'Zoneid'),
            'zonecode' => Yii::t('app', 'Zonecode'),
            'zonename' => Yii::t('app', 'Zonename'),
        ];
    }

    public static function getZoneName($id = null) {
        if ($id != '') {
            $data = Czone::find()
                    ->select('zonename')
                    ->where('zonecode="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $zonename = $v['zonename'];
            }
        } else {
            $zonename = '';
        }

        return $zonename;
    }

}
