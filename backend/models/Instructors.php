<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Instructor;

/**
 * Instructors represents the model behind the search form of `backend\models\Instructor`.
 */
class Instructors extends Instructor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['InstructorID', 'UserID'], 'integer'],
            [['fname', 'mname', 'lname', 'emailAddress', 'phoneNumber', 'profileImage'], 'safe'],
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
        $query = Instructor::find();

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
            'InstructorID' => $this->InstructorID,
            'UserID' => $this->UserID,
        ]);

        $query->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'mname', $this->mname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'emailAddress', $this->emailAddress])
            ->andFilterWhere(['like', 'phoneNumber', $this->phoneNumber])
            ->andFilterWhere(['like', 'profileImage', $this->profileImage]);

        return $dataProvider;
    }
}
