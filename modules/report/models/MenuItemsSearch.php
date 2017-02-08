<?php

namespace app\modules\report\models;

use yii\data\ActiveDataProvider;

class MenuItemsSearch extends MenuItems {

    public function rules() {
        return [
            // ... more stuff here
            [['menu_group_id',
            'menu_items_id',
            'menu_items_name',
            'menu_items_comment',
            'menu_items_url',
            'menu_items_user_create',
            'menu_items_user_update',
            'menu_items_status',
            'menu_items_active'
                ], 'safe'],
                // ... more stuff here
        ];
    }

    public function search($params, $condition = null) {
        if (!empty($condition)) {
            $query = MenuItems::find()->where($condition);
        } else {
            $query = MenuItems::find();
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
                #'sort' => ['defaultOrder' => ['menu_group_id' => SORT_ASC, 'menu_items_id' => SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'menu_items_id' => $this->menu_items_id,
            'menu_group_id' => $this->menu_group_id,
            'menu_items_user_update' => $this->menu_items_user_update,
            'menu_items_user_create' => $this->menu_items_user_create,
            'menu_items_status' => $this->menu_items_status,
            'menu_items_active' => $this->menu_items_active
        ]);

        $query->andFilterWhere(['like', 'menu_items_name', $this->menu_items_name])
                ->andFilterWhere(['like', 'menu_items_comment', $this->menu_items_comment]
        );

        return $dataProvider;
    }

}
