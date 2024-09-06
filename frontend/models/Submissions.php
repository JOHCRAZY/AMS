<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Submission;

/**
 * Submissions represents the model behind the search form of `frontend\models\Submission`.
 */
class Submissions extends Submission
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SubmissionID', 'AssignmentID', 'groupID', 'StudentID', 'score'], 'integer'],
            [['content', 'submissionDate', 'fileURL', 'AssignmentStatus', 'SubmissionStatus'], 'safe'],
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
            'AssignmentID' => $this->AssignmentID,
           // 'groupID' => $this->groupID,
            'StudentID' => $this->StudentID,
            'submissionDate' => $this->submissionDate,
            'score' => $this->score,
        ]);

        $query->andFilterWhere(['like', 'content', $this->SubmissionContent])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL])
            ->andFilterWhere(['like', 'AssignmentStatus', $this->AssignmentStatus])
            ->andFilterWhere(['like', 'SubmissionStatus', $this->SubmissionStatus]);

        return $dataProvider;
    }
}
