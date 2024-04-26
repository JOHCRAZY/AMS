<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Assignment;

/**
 * AssignmentSearch represents the model behind the search form of `frontend\models\Assignment`.
 */
class AssignmentSearch extends Assignment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AssignmentID', 'marks'], 'integer'],
            [['courseCode', 'assignment', 'title', 'content', 'description', 'fileURL', 'assignedDate', 'submissionDate', 'status'], 'safe'],
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
        $query = Assignment::find();

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
            'AssignmentID' => $this->AssignmentID,
            'assignedDate' => $this->assignedDate,
            'submissionDate' => $this->submissionDate,
            'marks' => $this->marks,
        ]);

        $query->andFilterWhere(['like', 'courseCode', $this->courseCode])
            ->andFilterWhere(['like', 'assignment', $this->assignment])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }


    public function searchIndividualAssignmentPending($params)
    {
        $query = Assignment::find()->where(['assignment'  => 'Individual Assignment','status' => 'pending']);

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
            'AssignmentID' => $this->AssignmentID,
            'assignedDate' => $this->assignedDate,
            'submissionDate' => $this->submissionDate,
            'marks' => $this->marks,
        ]);

        $query->andFilterWhere(['like', 'courseCode', $this->courseCode])
            ->andFilterWhere(['like', 'assignment', $this->assignment])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

    public function searchGroupAssignmentPending($params)
    {
        $query = Assignment::find()->where(['assignment' => 'Group Assignment','status' => 'pending']);

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
            'AssignmentID' => $this->AssignmentID,
            'assignedDate' => $this->assignedDate,
            'submissionDate' => $this->submissionDate,
            'marks' => $this->marks,
        ]);

        $query->andFilterWhere(['like', 'courseCode', $this->courseCode])
            ->andFilterWhere(['like', 'assignment', $this->assignment])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
