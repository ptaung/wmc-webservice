<?php

namespace app\modules\silasoft\Models;

use Yii;

/**
 * This is the model class for table "wmc_procedure".
 *
 * @property string $wmc_procedure_name
 * @property double $wmc_procedure_seq
 * @property string $wmc_procedure_comment
 * @property integer $wmc_procedure_active
 * @property string $wmc_procedure_startprocess
 * @property string $wmc_procedure_finishprocess
 * @property string $wmc_procedure_message
 * @property string $wmc_procedure_status
 * @property string $wmc_procedure_querystring
 */
class WmcProcedure extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wmc_procedure';
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
            [['wmc_procedure_name', 'wmc_procedure_seq'], 'required'],
            [['wmc_procedure_seq'], 'number'],
            [['wmc_procedure_comment', 'wmc_procedure_message', 'wmc_procedure_querystring'], 'string'],
            [['wmc_procedure_active'], 'integer'],
            [['wmc_procedure_startprocess', 'wmc_procedure_finishprocess'], 'safe'],
            [['wmc_procedure_name'], 'string', 'max' => 100],
            [['wmc_procedure_status'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'wmc_procedure_name' => 'Wmc Procedure Name',
            'wmc_procedure_seq' => 'Wmc Procedure Seq',
            'wmc_procedure_comment' => 'Wmc Procedure Comment',
            'wmc_procedure_active' => 'Wmc Procedure Active',
            'wmc_procedure_startprocess' => 'Wmc Procedure Startprocess',
            'wmc_procedure_finishprocess' => 'Wmc Procedure Finishprocess',
            'wmc_procedure_message' => 'Wmc Procedure Message',
            'wmc_procedure_status' => 'Wmc Procedure Status',
            'wmc_procedure_querystring' => 'Wmc Procedure Querystring',
        ];
    }

}
