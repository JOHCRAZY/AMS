<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Course;

/**
 * Courses represents the model behind the search form of `backend\models\Course`.
 */
class Courses extends Course
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['courseCode', 'courseName', 'semester', 'year', 'programmeCode'], 'safe'],
            [['courseInstructor'], 'integer'],
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
        $query = Course::find();

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
            'courseInstructor' => $this->courseInstructor,
        ]);

        $query->andFilterWhere(['like', 'courseCode', $this->courseCode])
            ->andFilterWhere(['like', 'courseName', $this->courseName])
            ->andFilterWhere(['like', 'semester', $this->semester])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'programmeCode', $this->programmeCode]);

        return $dataProvider;
    }
}

