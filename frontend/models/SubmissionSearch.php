<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Submission;

/**
 * SubmissionSearch represents the model behind the search form of `frontend\models\Submission`.
 */
class SubmissionSearch extends Submission
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SubmissionID', 'assignmentID', 'groupID', 'StudentID'], 'integer'],
            [['content', 'submissionDate', 'fileURL'], 'safe'],
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
        $query = Submission::find();

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
            'SubmissionID' => $this->SubmissionID,
            'assignmentID' => $this->assignmentID,
            'groupID' => $this->groupID,
            'StudentID' => $this->StudentID,
            'submissionDate' => $this->submissionDate,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL]);

        return $dataProvider;
    }
}
