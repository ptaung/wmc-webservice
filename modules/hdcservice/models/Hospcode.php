<?php

namespace app\modules\hdcservice\models;

use Yii;

/**
 * This is the model class for table "hospcode".
 *
 * @property string $amppart
 * @property string $chwpart
 * @property string $hospcode
 * @property string $hosptype
 * @property string $name
 * @property string $tmbpart
 * @property string $moopart
 * @property string $sss_code
 * @property string $sss_code_sub
 * @property string $hospcode506
 * @property string $addressid
 */
class Hospcode extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'hospcode';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_datacenter');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['hospcode'], 'required'],
            [['amppart', 'chwpart', 'tmbpart', 'moopart'], 'string', 'max' => 2],
            [['hospcode'], 'string', 'max' => 5],
            [['hosptype'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['sss_code', 'sss_code_sub'], 'string', 'max' => 12],
            [['hospcode506'], 'string', 'max' => 15],
            [['addressid'], 'string', 'max' => 6],
        ];
    }

    public function getFullname() {
        return "(" . $this->hospcode . ") | " . $this->name;
    }

    public function Listdata() {
        return Hospcode::find()->where('chwpart = "' . \Yii::$app->params['provcode'] . '"')->all();
    }

    public function ListHospital() {
        return Hospcode::find()->where('chwpart = 72 and hospcode in (select hospcode from pcu_hos_allow)')->all();
    }

    public function ListPcu() {
        return Hospcode::find()->where('chwpart = 72 and hospcode in (select hospcode from pcu_hos_allow)')->all();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'amppart' => Yii::t('app', 'Amppart'),
            'chwpart' => Yii::t('app', 'Chwpart'),
            'hospcode' => Yii::t('app', 'Hospcode'),
            'hosptype' => Yii::t('app', 'Hosptype'),
            'name' => Yii::t('app', 'Name'),
            'tmbpart' => Yii::t('app', 'Tmbpart'),
            'moopart' => Yii::t('app', 'Moopart'),
            'sss_code' => Yii::t('app', 'Sss Code'),
            'sss_code_sub' => Yii::t('app', 'Sss Code Sub'),
            'hospcode506' => Yii::t('app', 'Hospcode506'),
            'addressid' => Yii::t('app', 'Addressid'),
        ];
    }

}
