<?php

namespace app\modules\hdcservice\models;

use Yii;

/**
 * This is the model class for table "chospital".
 *
 * @property string $hoscode
 * @property string $hosname
 * @property string $hostype
 * @property string $address
 * @property string $road
 * @property string $mu
 * @property string $subdistcode
 * @property string $distcode
 * @property string $provcode
 * @property string $postcode
 * @property string $hoscodenew
 * @property string $bed
 * @property string $level_service
 * @property string $bedhos
 * @property integer $hdc_regist
 */
class Chospital extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'chospital';
    }

    public static function getDb() {
        return Yii::$app->get('db_hdc');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['hoscode'], 'required'],
            [['hdc_regist'], 'integer'],
            [['hoscode', 'postcode', 'bed', 'bedhos'], 'string', 'max' => 5],
            [['hosname', 'level_service'], 'string', 'max' => 255],
            [['hostype', 'mu', 'subdistcode', 'distcode', 'provcode'], 'string', 'max' => 2],
            [['address', 'road'], 'string', 'max' => 50],
            [['hoscodenew'], 'string', 'max' => 9],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'hoscode' => Yii::t('app', 'Hoscode'),
            'hosname' => Yii::t('app', 'Hosname'),
            'hostype' => Yii::t('app', 'Hostype'),
            'address' => Yii::t('app', 'Address'),
            'road' => Yii::t('app', 'Road'),
            'mu' => Yii::t('app', 'Mu'),
            'subdistcode' => Yii::t('app', 'Subdistcode'),
            'distcode' => Yii::t('app', 'Distcode'),
            'provcode' => Yii::t('app', 'Provcode'),
            'postcode' => Yii::t('app', 'Postcode'),
            'hoscodenew' => Yii::t('app', 'Hoscodenew'),
            'bed' => Yii::t('app', 'Bed'),
            'level_service' => Yii::t('app', 'Level Service'),
            'bedhos' => Yii::t('app', 'Bedhos'),
            'hdc_regist' => Yii::t('app', 'Hdc Regist'),
        ];
    }

    public function getFullname() {
        return "(" . $this->hoscode . ") | " . $this->hosname;
    }

    public function Listdata() {
        return Chospital::find()->where('hostype in ("01","02" ) ')->all();
    }

    public function ListHospital() {
        return Chospital::find()->where('hostype = 72 and hospcode in (select hospcode from pcu_hos_allow)')->all();
    }

    public function ListPcu() {
        return Chospital::find()->where('hostype = 72 and hospcode in (select hospcode from pcu_hos_allow)')->all();
    }

}
