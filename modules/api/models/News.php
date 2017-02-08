<?php

namespace app\modules\news\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $news_id
 * @property string $news_header
 * @property string $news_detail
 * @property string $news_date
 */
class News extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['news_header', 'news_detail'], 'required'],
            [['news_id'], 'integer'],
            [['news_count'], 'integer'],
            [['news_detail'], 'string'],
            [['news_date'], 'safe'],
            [['news_header'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'news_id' => 'รหัส',
            'news_header' => 'ชื่อเรื่อง',
            'news_detail' => 'รายละเอียด',
            'news_date' => 'วันที่',
            'news_count' => 'อ่าน',
        ];
    }

}
