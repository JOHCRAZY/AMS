<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Group;

/**
 * Groups represents the model behind the search form of `frontend\models\Group`.
 */
class Groups extends Group
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['GroupID', 'GroupNO', 'StudentID'], 'integer'],
            [['groupName', 'courseCode'], 'safe'],
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
            'GroupID' => $this->GroupID,
            'GroupNO' => $this->GroupNO,
            'StudentID' => $this->StudentID,
        ]);

        $query->andFilterWhere(['like', 'groupName', $this->groupName])
            ->andFilterWhere(['like', 'courseCode', $this->courseCode]);

        return $dataProvider;
    }
}
