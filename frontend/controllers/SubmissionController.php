<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\Submission;
use yii\web\NotFoundHttpException;
use frontend\models\SubmissionSearch;
use frontend\models\User;
use frontend\models\{Student,Assignment,Group,Instructor,Course};
use yii;

/**
 * SubmissionController implements the CRUD actions for Submission model.
 */
class SubmissionController extends Controller
{
    //public $layout = 'student';
    /**
     * @inheritDoc
     */
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
                            'actions' => ['index','mark', 'view','mark-individual','mark-group', 'create', 'update','individual-not-marked','group-marked','group-not-marked','individual-marked'],
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
    /**
     * Lists all Submission models.
     *
     * @return string
     */


    public function actionIndex()
    {
        $searchModel = new SubmissionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Submission model.
     * @param int $SubmissionID Submission ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($SubmissionID)
    {
        return $this->render('view', [
            'model' => $this->findModel($SubmissionID),
        ]);
    }

    /**
     * Creates a new Submission model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Submission();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'SubmissionID' => $model->SubmissionID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Submission model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $SubmissionID Submission ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($SubmissionID)
    {
        $model = $this->findModel($SubmissionID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'SubmissionID' => $model->SubmissionID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionIndividualMarked($courseCode = null){

        if($courseCode == null && !$this->isInstructor()){
            $ctrAct = 'submission/individual-marked';
            return $this->redirect(['/course/select','ctrAct' => $ctrAct]);
        }
       
        $searchModel = new SubmissionSearch();

        if($this->isStudent()){

            $dataProvider = $searchModel->searchIndividualMarked(Yii::$app->request->queryParams,$courseCode);

        }else{
            $dataProvider = $searchModel->searchIndividualMarked(Yii::$app->request->queryParams,null);

        }

        return $this->render('/submission/@assignment',[
           'dataProvider'=>$dataProvider,
           'searchModel'=>$searchModel,
           'title' =>  "Marked Individual Assignment"
        ]);
    }

    public function actionIndividualNotMarked($courseCode = null){

        if($courseCode == null && !$this->isInstructor()){
            $ctrAct = 'submission/individual-not-marked';
           return  $this->redirect(['/course/select','ctrAct' => $ctrAct]);
        }
        
        $searchModel = new SubmissionSearch();

        if($this->isStudent()){
            $dataProvider = $searchModel->searchIndividualNotMarked(Yii::$app->request->queryParams,$courseCode);

        }else{
            $dataProvider = $searchModel->searchIndividualNotMarked(Yii::$app->request->queryParams,null);

        }
        return $this->render('/submission/@assignment',[
           'dataProvider'=>$dataProvider,
           'searchModel'=>$searchModel,
           'title' =>  "Individual Assignment"
        ]);
    }

    protected static function instructorCourseCode(){
        $instructorID = Instructor::findOne(['UserID' => Yii::$app->user->getId()])->InstructorID;
        return Course::findOne(['courseInstructor' => $instructorID])->courseCode;
    }

    public function actionMarkIndividual($AssignmentID = null){

        $searchModel = new SubmissionSearch();

        if(!$this->isStudent()){
            $dataProvider = $searchModel->searchIndividualNotMarked(Yii::$app->request->queryParams,null,$AssignmentID);
        }else{
            return $this->goHome();

        }
        return $this->render('/submission/@individual',[
           'dataProvider'=>$dataProvider,
           'searchModel'=>$searchModel,
           'models' =>  Assignment::findAll(['courseCode' => self::instructorCourseCode(),'assignment' => 'Individual Assignment']),
           'AssignmentID' => $AssignmentID ?? 1,
        ]);
    }

    public function actionMarkGroup($AssignmentID = null){

        $searchModel = new SubmissionSearch();

        if(!$this->isStudent()){
            $dataProvider = $searchModel->searchGroupNotMarked(Yii::$app->request->queryParams,null,$AssignmentID);
        }else{
            return $this->goHome();

        }
        return $this->render('/submission/@group',[
           'dataProvider'=>$dataProvider,
           'searchModel'=>$searchModel,
           'models' =>  Assignment::findAll(['courseCode' => self::instructorCourseCode(),'assignment' => 'Group Assignment']),
           'AssignmentID' => $AssignmentID ?? 1,
        ]);
    }

    public function actionGroupMarked($courseCode = null){

        if($courseCode == null && !$this->isInstructor()){
            $ctrAct = 'submission/group-marked';
            return $this->redirect(['/course/select','ctrAct' => $ctrAct]);
        }
        if(!$this->isInstructor()){
            $group = Group::find()
                ->where(['StudentID' => self::getStudent()->StudentID, 'courseCode' => $courseCode])->one();

            if ($group == null) {

                //throw new yii\web\NotFoundHttpException(Yii::t('app', '( Group Not Found ) You\'re Not Assigned to Any Group in This Course'.'<br>'.'Contact Your Lecture for Assistance'));
                Yii::$app->session->setFlash('info', '( Group Not Found ) You\'re Not Assigned to Any Group in This Course<br>Contact Your Lecture for Assistance');
                 return $this->goBack();
            }
        }
        $searchModel = new SubmissionSearch();
        $dataProvider = $searchModel->searchGroupMarked(Yii::$app->request->queryParams,$courseCode);

        return $this->render('/submission/@assignment',[
           'dataProvider'=>$dataProvider,
           'searchModel'=>$searchModel,
           'title' =>  "Marked Group Assignment"
        ]);
    }

    public function actionGroupNotMarked($courseCode = null){

        if($courseCode == null && !$this->isInstructor()){

            $ctrAct = 'submission/group-not-marked';
            return $this->redirect(['/course/select','ctrAct' => $ctrAct]);
        }

        if(!$this->isInstructor()){
            $group = Group::find()
                ->where(['StudentID' => self::getStudent()->StudentID, 'courseCode' => $courseCode])->one();

            if ($group == null) {

                //throw new yii\web\NotFoundHttpException(Yii::t('app', '( Group Not Found ) You\'re Not Assigned to Any Group in This Course'.'<br>'.'Contact Your Lecture for Assistance'));
                Yii::$app->session->setFlash('info', '( Group Not Found ) You\'re Not Assigned to Any Group in This Course<br>Contact Your Lecture for Assistance');
                 return $this->goBack();
            }
        }
        $searchModel = new SubmissionSearch();
        $dataProvider = $searchModel->searchGroupNotMarked(Yii::$app->request->queryParams,$courseCode,null);

        return $this->render('/submission/@assignment',[
           'dataProvider'=>$dataProvider,
           'searchModel'=>$searchModel,
           'title' =>  "Group Assignments"
        ]);
    }

    /**
     * Deletes an existing Submission model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $SubmissionID Submission ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($SubmissionID)
    {
        $this->findModel($SubmissionID)->delete();

        return $this->redirect(['index']);
    }



    public function actionMark($SubmissionID,$Marked = false,$AssignmentID = null){

        $model = $this->findModel($SubmissionID);


        if($model->SubmissionStatus == 'Marked'){
            Yii::$app->session->setFlash('error', 'Assignment Already Marked.');
                return $this->redirect(['view','SubmissionID' => $SubmissionID]);
        }

        if($Marked && $this->isInstructor() && $this->request->isPost){

            $model->load($this->request->post());

            $total_marks = Assignment::findOne(['AssignmentID' => $AssignmentID])->marks;
            if($model->PreScore > $total_marks){
                Yii::$app->session->setFlash('info', 'Invalid Score, Score can\'t be greater than total marks.('.$total_marks.')');
            }else{

                $model->SubmissionStatus = 'Marked';
            $model->score = $model->PreScore;

            if($model->save()){

                Yii::$app->session->setFlash('success', 'Assignment Marked.');
                return $this->redirect(['view','SubmissionID' => $SubmissionID]);

            }else{
                Yii::$app->session->setFlash('error', 'Something went Wrong. Please enter valid Marks');
            }
            }
            
        }
        return $this->render('mark',[
        'model' => $model
    ]);
    }
    /**
     * Finds the Submission model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $SubmissionID Submission ID
     * @return Submission the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($SubmissionID)
    {
        if (($model = Submission::findOne(['SubmissionID' => $SubmissionID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
