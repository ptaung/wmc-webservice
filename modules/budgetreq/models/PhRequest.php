<?php

namespace app\modules\budgetreq\models;

use Yii;

/**
 * This is the model class for table "ph_request".
 *
 * @property integer $request_id
 * @property integer $budget_id
 * @property integer $budget_type_id
 * @property string $request_active
 *
 * @property PhOperationRequest[] $phOperationRequests
 * @property PhBudget $budgetBudget
 * @property PhBudgetType $budgetType
 */
class PhRequest extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ph_request';
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
            [['budget_id', 'budget_type_id'], 'required'],
            [['budget_id', 'budget_type_id'], 'integer'],
            [['request_active'], 'string', 'max' => 1],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhBudget::className(), 'targetAttribute' => ['budget_id' => 'budget_id']],
            [['budget_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhBudgetType::className(), 'targetAttribute' => ['budget_type_id' => 'budget_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'request_id' => Yii::t('app', 'ID'),
            'budget_id' => Yii::t('app', 'Budget'),
            'budget_type_id' => Yii::t('app', 'Budget Type'),
            'request_active' => Yii::t('app', 'status'),
        ];
    }

    /*
     * Custom Fields
     */

    public function getFullname() {
        return $this->budget->budget_name . " | " . $this->budgetType->budget_type_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhOperationRequests() {
        return $this->hasMany(PhOperationRequest::className(), ['request_id' => 'request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhRequests() {
        return $this->hasMany(PhRequest::className(), ['request_id' => 'request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudget() {
        return $this->hasOne(PhBudget::className(), ['budget_id' => 'budget_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudgetType() {
        return $this->hasOne(PhBudgetType::className(), ['budget_type_id' => 'budget_type_id']);
    }

}
