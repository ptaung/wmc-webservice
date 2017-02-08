<?php

namespace app\modules\hdcservice\models;

use Yii;
use app\models\User;

class MenuItems extends \yii\db\ActiveRecord {

    public $status;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sys_menu_items';
    }

    public static function getDb() {
        return Yii::$app->get('db_hdc');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            #[['menu_items_name'], 'unique'],
            [['menu_items_comment', 'menu_items_param'], 'string'],
            [['menu_items_datasource', 'menu_items_typeprocess', 'menu_items_url', 'menu_items_sqlquery', 'menu_items_columns'], 'string'],
            [['menu_items_id'], 'required'],
            [['menu_items_create', 'menu_items_update'], 'safe'],
            [['menu_group_id'], 'integer'],
            [['menu_items_name'], 'string', 'max' => 255],
            [['menu_items_active'], 'string', 'max' => 1],
            [['menu_items_user_create', 'menu_items_user_update', 'menu_items_status'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'menu_items_id' => Yii::t('app', 'รหัส'),
            'menu_items_name' => Yii::t('app', 'ชื่อเมนู'),
            'menu_items_active' => Yii::t('app', 'สถานะการใช้งาน'),
            'menu_items_comment' => Yii::t('app', 'ที่มา/หมายเหตุ'),
            'menu_group_id' => Yii::t('app', 'ชื่อกลุ่มเมนู'),
            'menu_items_url' => Yii::t('app', 'URL'),
            'menu_items_sqlquery' => Yii::t('app', 'SQLQuery'),
            'menu_items_columns' => Yii::t('app', 'Data Columns'),
            'menu_items_typeprocess' => Yii::t('app', 'Type Process'),
            'menu_items_datasource' => Yii::t('app', 'Data Source'),
            'menu_items_create' => Yii::t('app', 'สร้างเมื่อ'),
            'menu_items_update' => Yii::t('app', 'แก้ไขล่าสุด'),
            'menu_items_param' => Yii::t('app', 'param'),
            'menu_items_status' => Yii::t('app', 'status'),
            'menu_items_user_create' => Yii::t('app', 'สร้างโดย'),
            'menu_items_user_update' => Yii::t('app', 'แก้ไขโดย'),
        ];
    }

    public static function getStatus() {
        return ['0' => '0 กำลังดำเนินการ', '1' => '1 กำลังทดสอบ', '2' => '2 พร้อมใช้งาน'];
    }

    public function afterFind() {
        //เข้ารหัสในฐานข้อมูเพื่อความปลอดภัย
        //parent::afterFind();
        $this->menu_items_columns = base64_decode($this->menu_items_columns);
        $this->menu_items_sqlquery = base64_decode($this->menu_items_sqlquery);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuGroup() {
        return $this->hasOne(MenuGroup::className(), ['menu_group_id' => 'menu_group_id']);
    }

    public function getUserCreate() {
        return $this->hasOne(User::className(), ['id' => 'menu_items_user_create']);
    }

    public function getUserUpdate() {
        return $this->hasOne(User::className(), ['id' => 'menu_items_user_update']);
    }

    public function getSysreport() {
        return $this->hasOne(Sysreport::className(), ['id' => 'menu_items_id']);
    }

    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->menu_items_create = new \yii\db\Expression('NOW()');
            $this->menu_items_user_create = \Yii::$app->user->getId();
        } else {
            $this->menu_items_update = new \yii\db\Expression('NOW()');
            if (empty($this->menu_items_user_create))
                $this->menu_items_user_create = \Yii::$app->user->getId();
            $this->menu_items_user_update = \Yii::$app->user->getId();
        }

        $this->menu_items_columns = base64_encode($this->menu_items_columns);
        $this->menu_items_sqlquery = base64_encode($this->menu_items_sqlquery);

        return parent::beforeSave($insert);
    }

}
