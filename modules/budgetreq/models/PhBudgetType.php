<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_budget_type".
 *
 * @property integer $budget_type_id
 * @property string $budget_type_name
 * @property integer $budget_type_order
 * @property string $budget_type_active
 *
 * @property PhRequest[] $phRequests
 */
class PhBudgetType extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_budget_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('phdb');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['budget_type_order'], 'integer'],
            [['budget_type_name'], 'string', 'max' => 255],
            [['budget_type_active'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'budget_type_id' => Yii::t('app', 'รหัส'),
            'budget_type_name' => Yii::t('app', 'ชื่อประเภทคำขอ'),
            'budget_type_order' => Yii::t('app', 'ลำดับที่'),
            'budget_type_active' => Yii::t('app', 'สถานะใช้งาน'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhRequests() {
        return $this->hasMany(PhRequest::className(), ['budget_type_id' => 'budget_type_id']);
    }

}
