<?php

namespace app\modules\webclient\models;

use Yii;

/**
 * This is the model class for table "wm_vaccine_type".
 *
 * @property string $vaccine_name
 * @property string $vaccine_code
 * @property integer $age_min
 * @property integer $age_max
 * @property string $export_code
 */
class VaccineType extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wm_vaccine_type';
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
            [['vaccine_name'], 'required'],
            [['age_min', 'age_max'], 'integer'],
            [['vaccine_name'], 'string', 'max' => 150],
            [['vaccine_code'], 'string', 'max' => 20],
            [['export_code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'vaccine_name' => 'Vaccine Name',
            'vaccine_code' => 'Vaccine Code',
            'age_min' => 'Age Min',
            'age_max' => 'Age Max',
            'export_code' => 'Export Code',
        ];
    }

    public function getFullname() {
        return "(" . $this->export_code . ") | " . $this->vaccine_name;
    }

}
