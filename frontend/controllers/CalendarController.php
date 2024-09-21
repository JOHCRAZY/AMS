<?php 

namespace frontend\controllers;
use frontend\models\{Student, User, Instructor, Course, Assignment, Submission};
use yii;
use yii\filters\VerbFilter;
use edofre\fullcalendar\models\Event;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
class CalendarController extends  yii\web\Controller{

    //public $layout = 'blank';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => \yii\filters\AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index','events'],
                            'allow' => true,
                            'matchCallback' => function ($rule, $action) {
                                // Custom logic to determine access
                                return !Yii::$app->user->isGuest; // Allow if user is authenticated
                            },
                        ],
                    ],
                ],
            ]
        );
    }

    protected function isInstructor(){
        return User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor';

    }
    protected function isStudent(){
        return User::findByUsername(Yii::$app->user->identity->username)->role == 'student';

    }
    protected static function getStudent()
    {
        $user = User::findByUsername(Yii::$app->user->identity->username);
        return Student::find()->where(['UserID' => $user->UserID])->one();
    }

    public function actionIndex(){

        return $this->render('index');
    }


    public function actionEvents()
{
    if(self::isStudent()){
        $enrolledCourses = Course::find()
            ->select('courseCode')
            ->where(['programmeCode' => self::getStudent()->programmeCode,'year' => self::getStudent()->year,'semester' => self::getStudent()->semester]);
       
         $assignments = Assignment::find()
            ->where(['IN','courseCode', $enrolledCourses])
            ->andWhere(['status' => 'Assigned'])
            ->all();


    }else{

        $instructorID = Instructor::findOne(['UserID' => yii::$app->user->id])->InstructorID;

        $courseCode = Course::find()
            ->where(['courseInstructor' => $instructorID])->one()->courseCode;

        $assignments = Assignment::find()
            ->where(['courseCode' => $courseCode])
            ->all();
    }
  
    
    $events = [];

    foreach ($assignments as $assignment) {

        

        if(self::isStudent()){

            $event = new Event([
                'id'               => $assignment->AssignmentID,
                'title'            => $assignment->title,
                'start'            => Yii::$app->formatter->asDatetime($assignment->assignedDate, 'php:Y-m-d\TH:i:s'),
                'overlap'          => false,
                'editable'         => true,
                'startEditable'    => true,
                'durationEditable' => true,
                'className' => 'card p-1 bg-info elevation-2',
                'url' => Url::to(['/assignment/view','AssignmentID' => $assignment->AssignmentID]),
    
            ]);
            $events[] = $event;

        $submissions = Submission::find()
        ->Where(['AssignmentID' => $assignment->AssignmentID,'Submission.StudentID' => self::getStudent()->StudentID])->one();

        if($submissions != null){

            if($submissions->AssignmentStatus == 'Submitted'){
                $class = 'card p-1 bg-success elevation-5';
            }else{
                $class = 'card p-1 bg-secondary elevation-5';
            }
        }else{
            $class = 'card p-1 bg-warning elevation-5';
        }
        $event = new Event([
            'id'               => $assignment->AssignmentID,
            'title'            => $assignment->title,
            'start'            => Yii::$app->formatter->asDatetime($assignment->submissionDate, 'php:Y-m-d\TH:i:s'), //Yii::$app->formatter->asDatetime($assignment->assignedDate, 'php:Y-m-d\TH:i:s'),
            'overlap'          => false,
            'editable'         => true,
            'startEditable'    => true,
            'durationEditable' => true,
            'className' => $class,
            'url' => Url::to(['/assignment/view','AssignmentID' => $assignment->AssignmentID]),

        ]);
        $events[] = $event;
        }else{

            if($assignment->status == 'Assigned'){
                $class = 'card p-1 bg-success';
                $url = $assignment->assignment == 'Individual Assignment' ? Url::to(['submission/mark-individual' ,'AssignmentID' => $assignment->AssignmentID]) : Url::to(['submission/mark-group' ,'AssignmentID' => $assignment->AssignmentID]);
           
            }else{

                $class = 'card p-1 bg-info';
                $url = Url::to(['/assignment/view','AssignmentID' => $assignment->AssignmentID]);
            }
           
            $event = new Event([
            'id'               => $assignment->AssignmentID,
            'title'            => $assignment->title,
            'start'            => yii::$app->formatter->asDatetime($assignment->assignedDate, 'php:Y-m-d\TH:i:s'),
            'overlap'          => false,
            'editable'         => true,
            'startEditable'    => true,
            'durationEditable' => true,
            'className' => $class,
            'url' => $url,
            ]);

            $events[] = $event;

        }


    }

    return $this->asJson($events); 
}

}
