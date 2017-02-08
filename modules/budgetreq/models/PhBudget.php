<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_budget".
 *
 * @property integer $budget_id
 * @property string $budget_name
 * @property integer $budget_order
 * @property string $budget_active
 *
 * @property PhRequest[] $phRequests
 */
class PhBudget extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_budget';
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
            [['budget_order'], 'integer'],
            [['budget_name'], 'string', 'max' => 255],
            [['budget_active'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'budget_id' => Yii::t('app', 'รหัส'),
            'budget_name' => Yii::t('app', 'ชื่อคำขอ'),
            'budget_order' => Yii::t('app', 'ลำดับที่'),
            'budget_active' => Yii::t('app', 'สถานะใช้งาน'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhRequests() {
        return $this->hasMany(PhRequest::className(), ['budget_budget_id' => 'budget_id']);
    }

}
