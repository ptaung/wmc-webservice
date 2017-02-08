<?php

namespace app\modules\silasoft\Models;

use Yii;

/**
 * This is the model class for table "wmc_xalert".
 *
 * @property string $wmc_xalert_id
 * @property integer $wmc_xalert_active
 * @property string $wmc_xalert_title
 * @property string $wmc_xalert_query
 * @property string $wmc_xalert_status
 * @property double $wmc_xalert_orderby
 * @property string $wmc_xalert_querytype
 * @property string $wmc_xalert_start
 * @property string $wmc_xalert_finish
 * @property string $wmc_xalert_message
 * @property string $wmc_xalert_name
 */
class WmcXalert extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wmc_xalert';
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
            [['wmc_xalert_id'], 'required'],
            [['wmc_xalert_active'], 'integer'],
            [['wmc_xalert_query'], 'string'],
            [['wmc_xalert_orderby'], 'number'],
            [['wmc_xalert_start', 'wmc_xalert_finish'], 'safe'],
            [['wmc_xalert_id'], 'string', 'max' => 50],
            [['wmc_xalert_title', 'wmc_xalert_status', 'wmc_xalert_message', 'wmc_xalert_name'], 'string', 'max' => 255],
            [['wmc_xalert_querytype'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'wmc_xalert_id' => 'Wmc Xalert ID',
            'wmc_xalert_active' => 'Wmc Xalert Active',
            'wmc_xalert_title' => 'Wmc Xalert Title',
            'wmc_xalert_query' => 'Wmc Xalert Query',
            'wmc_xalert_status' => 'Wmc Xalert Status',
            'wmc_xalert_orderby' => 'Wmc Xalert Orderby',
            'wmc_xalert_querytype' => 'Wmc Xalert Querytype',
            'wmc_xalert_start' => 'Wmc Xalert Start',
            'wmc_xalert_finish' => 'Wmc Xalert Finish',
            'wmc_xalert_message' => 'Wmc Xalert Message',
            'wmc_xalert_name' => 'Wmc Xalert Name',
        ];
    }

}
