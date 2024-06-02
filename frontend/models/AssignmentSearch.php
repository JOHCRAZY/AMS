<?php

namespace frontend\models;

use yii\base\Model;
use yii;
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

    protected static function getStudent(){
        $user = User::findByUsername(Yii::$app->user->identity->username);
      return \frontend\models\Student::find()->where(['UserID' => $user->UserID])->one();
    }


    protected function isInstructor(){
        return User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor';

    }
    protected function isStudent(){
        return User::findByUsername(Yii::$app->user->identity->username)->role == 'student';

    }

    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$courseCode)
    {
        
    if($this->isInstructor()){
        $query = Assignment::find()
        ->where(['courseCode' => $courseCode]);

    }else{


       if(self::getStudent() != null){

        $query = Assignment::find()
        ->joinWith('submissions')
        ->where(['IN', 'courseCode', 
        Course::find()
        ->select('courseCode')
        ->where(['programmeCode' => self::getStudent()->programmeCode,'year' => self::getStudent()->year,'semester' => self::getStudent()->semester])]
       )
       ->andFilterWhere(['status' => 'Assigned'])
      //->andFilterWhere([]);
    ;
       }
    }
            // ->joinWith('courseCode0')
            // ->where(['Course.courseCode'  => $instructor->CourseCode ,'status' => 'Assigned']);

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
            ->andFilterWhere(['like', 'content', $this->AssignmentContent])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }


    public function searchIndividualAssignmentPending($params,$courseCode)
    {

        
        // if($this->isInstructor()){
        //     $query = Assignment::find()
        //     ->joinWith('submissions')
        //     ->joinWith('courseCode0')
        //     ->where(['Course.courseCode' => Instructor::find()->where(['UserID' => \Yii::$app->user->getId()])->one()->CourseCode,'Assignment.assignment'  => 'Individual Assignment','status' => 'Assigned','Submission.SubmissionStatus' => 'Not Marked']);
        // }else{

            $query = Assignment::find()
            ->joinWith('submissions')
            ->where([
                'Assignment.assignment'  => 'Individual Assignment',
                'Assignment.courseCode' => $courseCode,
                'Submission.StudentID' => self::getStudent()->StudentID,
                'status' => 'Assigned',
                'Submission.AssignmentStatus' => 'Pending'
            ]);
       // }

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
            ->andFilterWhere(['like', 'content', $this->AssignmentContent])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }



    public function searchGroupAssignmentPending($params,$courseCode)
    {


        $groupNO = Group::find()
        ->where([
            'StudentID' => self::getStudent()->StudentID,
            'courseCode' => $courseCode
            ])
        ->one()->GroupNO;

        $query = Assignment::find()
        ->joinWith('submissions')
        ->where([
            'Assignment.assignment' => 'Group Assignment',
            'Assignment.courseCode' => $courseCode,
            'Assignment.status' => 'Assigned',
            'Submission.groupNO' => $groupNO,
            'Submission.AssignmentStatus' => 'Pending'

        ]);
    
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
            ->andFilterWhere(['like', 'content', $this->AssignmentContent])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'fileURL', $this->fileURL])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
