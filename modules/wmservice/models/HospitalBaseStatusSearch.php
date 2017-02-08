<?php

namespace app\modules\wmservice\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\wmservice\models\HospitalBaseStatus;

/**
 * HospitalBaseStatusSearch represents the model behind the search form about `app\models\HospitalBaseStatus`.
 */
class HospitalBaseStatusSearch extends HospitalBaseStatus {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['hbs_hospital_id', 'hbs_time', 'hbs_ip', 'hbs_browser', 'hbs_info', 'hbs_secretkey', 'hbs_sync_start', 'hbs_sync_finish', 'hbs_status_process', 'hbs_error', 'hbs_version', 'hbs_sync', 'hbs_update', 'hbs_command'], 'safe'],
            [['hbs_upload_size'], 'number'],
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
        $query = HospitalBaseStatus::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'hbs_time' => $this->hbs_time,
            'hbs_sync_start' => $this->hbs_sync_start,
            'hbs_sync_finish' => $this->hbs_sync_finish,
            'hbs_upload_size' => $this->hbs_upload_size,
        ]);

        $query->andFilterWhere(['like', 'hbs_hospital_id', $this->hbs_hospital_id])
                ->andFilterWhere(['like', 'hbs_ip', $this->hbs_ip])
                ->andFilterWhere(['like', 'hbs_browser', $this->hbs_browser])
                ->andFilterWhere(['like', 'hbs_info', $this->hbs_info])
                ->andFilterWhere(['like', 'hbs_secretkey', $this->hbs_secretkey])
                ->andFilterWhere(['like', 'hbs_status_process', $this->hbs_status_process])
                ->andFilterWhere(['like', 'hbs_error', $this->hbs_error])
                ->andFilterWhere(['like', 'hbs_version', $this->hbs_version])
                ->andFilterWhere(['like', 'hbs_sync', $this->hbs_sync])
                ->andFilterWhere(['like', 'hbs_update', $this->hbs_update])
                ->andFilterWhere(['like', 'hbs_command', $this->hbs_command]);

        return $dataProvider;
    }

}
