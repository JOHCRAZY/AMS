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
            [['SubmissionID', 'AssignmentID', 'groupNO', 'StudentID', 'score'], 'integer'],
            [['content', 'submissionDate', 'fileURL', 'status'], 'safe'],
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

    protected function isInstructor(){
        return User::findByUsername(\Yii::$app->user->identity->username)->role == 'instructor';

    }
    protected function isStudent(){
        return User::findByUsername(\Yii::$app->user->identity->username)->role == 'student';

    }

    protected static function getStudentID(){

        $user = User::findByUsername(\Yii::$app->user->identity->username);
      return \frontend\models\Student::find()->where(['UserID' => $user->UserID])->one();
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
            'groupNO' => $this->groupNO,
            'StudentID' => $this->StudentID,
            'submissionDate' => $this->submissionDate,
            'score' => $this->score,
        ]);

        $query->andFilterWhere(['like', 'SubmissionContent', $this->SubmissionContent])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL])
            ->andFilterWhere(['like', 'AssignmentStatus', $this->AssignmentStatus]);

        return $dataProvider;
    }

    public function searchIndividualMarked($params,$courseCode)
    {
        

        if($this->isInstructor()){ 

         $query = Submission::find()
         ->joinWith('assignment')
         ->where([
            'Assignment.courseCode' => Course::find()->where([
                'courseInstructor' => Instructor::find()->where([
                    'UserID' => \Yii::$app->user->getId()
                    ])->one()
                    ])->one()->courseCode,
                    'Assignment.assignment' => 'Individual Assignment',
                    'Submission.AssignmentStatus' => 'Submitted',
                    'Submission.SubmissionStatus' => 'Marked'
                ]);

        }else{

            $query = Submission::find()
        ->joinWith('assignment')
        ->where([
            'Assignment.assignment' => 'Individual Assignment',
            'Assignment.courseCode' => $courseCode,
            'StudentID' => self::getStudentID()->StudentID,
            'Submission.AssignmentStatus' => 'Submitted',
            'Submission.SubmissionStatus' => 'Marked'
        ]);
        }

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
            'groupNO' => $this->groupNO,
            'StudentID' => $this->StudentID,
            'submissionDate' => $this->submissionDate,
            'score' => $this->score,
        ]);

        $query->andFilterWhere(['like', 'SubmissionContent', $this->SubmissionContent])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL])
            ->andFilterWhere(['like', 'AssignmentStatus', $this->AssignmentStatus]);

        return $dataProvider;
    }
    public function searchIndividualNotMarked($params,$courseCode)
    {

        

        if($this->isInstructor()){
            $query = Submission::find()
        ->joinWith('assignment')
        ->where([
            'Assignment.courseCode' => Course::find()->where([
                'courseInstructor' => Instructor::find()->where([
                    'UserID' => \Yii::$app->user->getId()
                    ])->one()
                    ])->one()->courseCode,
                    'Assignment.assignment' => 'Individual Assignment',
                    'Submission.AssignmentStatus' => 'Submitted',
                    'Submission.SubmissionStatus' => 'Not Marked'
                ]);
        
    }else{

        $query = Submission::find()
        ->joinWith('assignment')
        ->where([
            'Assignment.assignment' => 'Individual Assignment',
            'Assignment.courseCode' => $courseCode,
            'StudentID' => self::getStudentID()->StudentID,
            'Submission.AssignmentStatus' => 'Submitted',
            'Submission.SubmissionStatus' => 'Not Marked'
        ]);
        }

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
            'groupNO' => $this->groupNO,
            'StudentID' => $this->StudentID,
            'submissionDate' => $this->submissionDate,
            'score' => $this->score,
        ]);

        $query->andFilterWhere(['like', 'SubmissionContent', $this->SubmissionContent])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL])
            ->andFilterWhere(['like', 'AssignmentStatus', $this->AssignmentStatus]);

        return $dataProvider;
    }

    protected static function getStudentInfo(){
        $user = User::findByUsername(\Yii::$app->user->identity->username);
      return \frontend\models\Student::find()->where(['UserID' => $user->UserID])->one();
    }
    public function searchGroupMarked($params,$courseCode)
    {
        
        if($this->isInstructor()){

        $query = Submission::find()
        ->joinWith('assignment')
        ->where([
            'Assignment.courseCode' => Course::find()->where([
                'courseInstructor' => Instructor::find()->where([
                    'UserID' => \Yii::$app->user->getId()
                    ])->one()
                ])->one()->courseCode,
                'Assignment.assignment' => 'Group Assignment',
                'Submission.AssignmentStatus' => 'Submitted',
                'Submission.SubmissionStatus' => 'Marked'
            ]);

        }else{
            $groupNO = Group::find()
            ->where([
                'StudentID' => self::getStudentInfo()->StudentID,
                'courseCode' => $courseCode
                ])
            ->one()->GroupNO;
    
            $query = Submission::find()
            ->joinWith('assignment')
            ->where([
                'Assignment.assignment' => 'Group Assignment',
                'Assignment.courseCode' => $courseCode,
                'Submission.AssignmentStatus' => 'Submitted',
                'Submission.GroupNO' => $groupNO,
                'Submission.SubmissionStatus' => 'Marked'
            ]);
        }
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
            'groupNO' => $this->groupNO,
            'StudentID' => $this->StudentID,
            'submissionDate' => $this->submissionDate,
            'score' => $this->score,
        ]);

        $query->andFilterWhere(['like', 'SubmissionContent', $this->SubmissionContent])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL])
            ->andFilterWhere(['like', 'AssignmentStatus', $this->AssignmentStatus]);

        return $dataProvider;
    }


    public function searchGroupNotMarked($params,$courseCode)
    {
        

        if($this->isInstructor()){

            $query = Submission::find()
        ->joinWith('assignment')
        ->where([
            'Assignment.courseCode' => Course::find()->where([
                'courseInstructor' => Instructor::find()->where([
                    'UserID' => \Yii::$app->user->getId()
                    ])->one()
                    ])->one()->courseCode,
                    'Assignment.assignment' => 'Group Assignment',
                    'Submission.AssignmentStatus' => 'Submitted',
                    'Submission.SubmissionStatus' => 'Not Marked'
                ]);
        
    }else{

        $groupNO = Group::find()
        ->where([
            'StudentID' => self::getStudentInfo()->StudentID,
            'courseCode' => $courseCode
            ])
        ->one()->GroupNO;

        $query = Submission::find()
        ->joinWith('assignment')
        ->where([
            'Assignment.assignment' => 'Group Assignment',
            'Assignment.courseCode' => $courseCode,
            'Submission.AssignmentStatus' => 'Submitted',
            'Submission.GroupNO' => $groupNO,
            'Submission.SubmissionStatus' => 'Not Marked'
        ]);
        }
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
            'groupNO' => $this->groupNO,
            'StudentID' => $this->StudentID,
            'submissionDate' => $this->submissionDate,
            'score' => $this->score,
        ]);

        $query->andFilterWhere(['like', 'SubmissionContent', $this->SubmissionContent])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL])
            ->andFilterWhere(['like', 'AssignmentStatus', $this->AssignmentStatus]);

        return $dataProvider;
    }
}
