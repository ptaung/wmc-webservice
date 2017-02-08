<?php

/*
 * Modified by silasoft
 *
 */

namespace app\modules\silasoft\models;

use dektrium\user\Finder;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use dektrium\user\models\UserSearch as BaseUserSearch;
use app\modules\webclient\components\Cdata;

/**
 * UserSearch represents the model behind the search form about User.
 */
class ExtUserSearch extends BaseUserSearch {

    public $hospcode;

    /** @inheritdoc */
    public function rules() {
        return [
            'fieldsSafe' => [['username', 'email', 'registration_ip', 'created_at', 'hospcode'], 'safe'],
            'createdDefault' => ['created_at', 'default', 'value' => null],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels() {
        return [
            'username' => Yii::t('user', 'Username'),
            'email' => Yii::t('user', 'Email'),
            'created_at' => Yii::t('user', 'Registration time'),
            'registration_ip' => Yii::t('user', 'Registration ip'),
            'hospcode' => Yii::t('user', 'สถานบริการ'),
        ];
    }

    public function search($params) {
        $query = $this->finder->getUserQuery();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                    'hospcode' => SORT_ASC,
                ]
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        $query->joinWith(['profile']);

        #อนุญาตให้ admin จังหวัดและอำเภอเข้าจัดการผู้ใช้งานภายในอำเภอตัวเอง
        if (Yii::$app->user->can('MANAGE-USER')) {

            #$query->leftJoin('chospital c', 'c.hoscode = p.hospcode');
            $ghospcode = Cdata::levelLookup();
            $query->andWhere("hospcode IN ({$ghospcode})");
        }
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->created_at !== null) {
            $date = strtotime($this->created_at);
            $query->andFilterWhere(['between', 'created_at', $date, $date + 3600 * 24]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'hospcode', $this->hospcode])
                ->andFilterWhere(['registration_ip' => $this->registration_ip]);

        return $dataProvider;
    }

}
