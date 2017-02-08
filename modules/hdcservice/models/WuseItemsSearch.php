<?php

namespace app\modules\hdcservice\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\hdcservice\models\WuseItems;

/**
 * WuseItemsSearch represents the model behind the search form about `app\modules\report\models\WuseItems`.
 */
class WuseItemsSearch extends WuseItems {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['hoscode', 'create_at', 'update_at'], 'safe'],
            [['menu_items_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = WuseItems::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'menu_items_id' => $this->menu_items_id,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'hoscode', $this->hoscode]);

        return $dataProvider;
    }

}
