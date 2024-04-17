<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Programme;

/**
 * Programmes represents the model behind the search form of `backend\models\Programme`.
 */
class Programmes extends Programme
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['programmeCode', 'programmeName'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Programme::find();

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
        $query->andFilterWhere(['like', 'programmeCode', $this->programmeCode])
            ->andFilterWhere(['like', 'programmeName', $this->programmeName]);

        return $dataProvider;
    }
}
