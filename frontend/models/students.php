<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Student;

/**
 * students represents the model behind the search form of `frontend\models\Student`.
 */
class students extends Student
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['StudentID', 'userID', 'groupID'], 'integer'],
            [['fname', 'mname', 'lname', 'session', 'regNo', 'phoneNumber', 'emailAddress', 'gender', 'profileImage', 'programmeCode', 'year', 'semester'], 'safe'],
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
        $query = Student::find();

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
            'StudentID' => $this->StudentID,
            'userID' => $this->userID,
            'groupID' => $this->groupID,
        ]);

        $query->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'mname', $this->mname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'session', $this->session])
            ->andFilterWhere(['like', 'regNo', $this->regNo])
            ->andFilterWhere(['like', 'phoneNumber', $this->phoneNumber])
            ->andFilterWhere(['like', 'emailAddress', $this->emailAddress])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'profileImage', $this->profileImage])
            ->andFilterWhere(['like', 'programmeCode', $this->programmeCode])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'semester', $this->semester]);

        return $dataProvider;
    }
}
