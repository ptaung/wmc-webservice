<?php

namespace app\modules\hdcservice\models;

use Yii;

/**
 * This is the model class for table "cmastercup".
 *
 * @property integer $oid
 * @property string $province_id
 * @property string $hospcode5
 * @property string $hmain
 * @property string $hsub
 * @property string $hmainname
 * @property string $hmaintype
 * @property string $d_update
 * @property string $changwatcode
 * @property string $changwatname
 * @property string $ampurcode
 * @property string $ampurname
 * @property string $tamboncode
 * @property string $tambonname
 * @property string $villagecode
 * @property string $village
 * @property string $address
 * @property string $postcode
 * @property string $catma
 * @property string $catm
 * @property string $datecancelcode
 * @property string $edit_time
 * @property string $hospcode9
 * @property string $is_pcu
 * @property string $area_code
 */
class Cmastercup extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cmastercup';
    }

    public static function getDb() {
        return Yii::$app->get('db_hdc');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['edit_time'], 'safe'],
            [['province_id'], 'string'],
            [['hospcode5', 'hmain', 'hsub', 'hmaintype', 'changwatcode', 'ampurcode', 'tamboncode', 'villagecode', 'address', 'postcode', 'hospcode9'], 'string', 'max' => 255],
            [['hmainname', 'hsubname', 'changwatname', 'ampurname', 'tambonname', 'village', 'catma'], 'string', 'max' => 255],
            [['d_update', 'catm', 'datecancelcode'], 'string'],
            [['is_pcu'], 'string', 'max' => 1],
            [['area_code'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'oid' => 'Oid',
            'province_id' => 'Province ID',
            'hospcode5' => 'Hospcode5',
            'hmain' => 'Hmain',
            'hsub' => 'Hsub',
            'hmainname' => 'Hmainname',
            'hsubname' => 'Hsubname',
            'hmaintype' => 'Hmaintype',
            'd_update' => 'D Update',
            'changwatcode' => 'Changwatcode',
            'changwatname' => 'Changwatname',
            'ampurcode' => 'Ampurcode',
            'ampurname' => 'Ampurname',
            'tamboncode' => 'Tamboncode',
            'tambonname' => 'Tambonname',
            'villagecode' => 'Villagecode',
            'village' => 'Village',
            'address' => 'Address',
            'postcode' => 'Postcode',
            'catma' => 'Catma',
            'catm' => 'Catm',
            'datecancelcode' => 'Datecancelcode',
            'edit_time' => 'Edit Time',
            'hospcode9' => 'Hospcode9',
            'is_pcu' => 'Is Pcu',
            'area_code' => 'Area Code',
        ];
    }

    public static function getMastercupName($id) {
        if ($id != '') {
            $data = Chospital::find()
                    ->select('hosname')
                    ->where('hoscode="' . $id . '"')
                    ->groupBy('hoscode')
                    ->all();
            foreach ($data as $v) {
                $mastercupname = $v['hosname'];
            }
        } else {
            $mastercupname = '';
        }

        return $mastercupname;
    }

}
