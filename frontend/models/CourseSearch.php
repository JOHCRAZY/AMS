<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Course;

/**
 * CourseSearch represents the model behind the search form of `frontend\models\Course`.
 */
class CourseSearch extends Course
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
    public function search($params, $semester, $year, $programmeCode)
    {
        $query = Course::find()
        //->joinWith(['instructors'])
        ->where(['semester' => $semester, 'year' => $year, 'programmeCode' => $programmeCode]);

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
