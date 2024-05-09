<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Group;

/**
 * Groups represents the model behind the search form of `backend\models\Group`.
 */
class Groups extends Group
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['groupID', 'groupNo'], 'integer'],
            [['courseCode', 'groupName'], 'safe'],
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
        $query = Group::find();

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
            'groupID' => $this->groupID,
            'groupNo' => $this->groupNo,
        ]);

        $query->andFilterWhere(['like', 'courseCode', $this->courseCode])
            ->andFilterWhere(['like', 'groupName', $this->groupName]);

        return $dataProvider;
    }
}
