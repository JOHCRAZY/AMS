<?php

namespace frontend\controllers;

use DateTime;
use frontend\models\Assignment;
use frontend\models\AssignmentSearch;
use frontend\models\Submission;
use frontend\models\User;
use frontend\models\Student;
use yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\Instructor;
use frontend\models\Course;

include_once 'Selector.php';
/**
 * AssignmentController implements the CRUD actions for Assignment model.
 */
class AssignmentController extends Controller
{
    //public $layout = "student";
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
                            'actions' => ['index', 'view', 'view-file', 'load-file', 'create', 'update', 'group', 'individual', 'do', 'submit'],
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

    public function actionViewFile($filePath)
    {
        return $this->render('view-file', [
            'filePath' => $filePath,
        ]);
    }

    public function actionLoadFile($filePath)
    {
        // Set proper MIME type based on file extension
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'txt' => 'text/plain',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'csv' => 'text/csv',
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'tar' => 'application/x-tar',
            'gz' => 'application/gzip',
            'mp3' => 'audio/mpeg',
            'wav' => 'audio/wav',
            'ogg' => 'audio/ogg',
            'mp4' => 'video/mp4',
            'avi' => 'video/x-msvideo',
            'mpg' => 'video/mpeg',
            'mpeg' => 'video/mpeg',
        ];

        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        $mimeType = isset($mimeTypes[$fileExtension]) ? $mimeTypes[$fileExtension] : 'application/octet-stream';

        // Set proper headers
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', $mimeType);

        // Output the file content
        return file_get_contents(Yii::getAlias('@webroot') . '/attachments/' . $filePath);
    }


    protected function isInstructor(){
        return User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor';

    }
    protected function isStudent(){
        return User::findByUsername(Yii::$app->user->identity->username)->role == 'student';

    }
    /**
     * Lists all Assignment models.
     *
     * @return string|mixed
     */
    public function actionIndex()
    {
        // $student = User::findByUsername(Yii::$app->user->identity->username)->role == 'student';
        // if ($student) {
        //     $searchModel = new AssignmentSearch();
        //     $dataProvider = $searchModel->searchNew(Yii::$app->request->queryParams,Student::find()->where(['userID' => yii::$app->user->id])->one()->StudentID);

        //     return $this->render('/assignment/@assignment', [
        //         'dataProvider' => $dataProvider,
        //         'searchModel' => $searchModel,
        //         'title' => "Individual Assignments",
        //     ]);
        // }
        $courseCode = Course::find()->where(['courseInstructor' => Instructor::find()->where(['UserID' => Yii::$app->user->getId()])->one()])->one()->courseCode;
        $searchModel = new AssignmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams,$courseCode);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Assignment model.
     * @param int $AssignmentID Assignment ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($AssignmentID)
    {
        return $this->render('view', [
            'model' => $this->findModel($AssignmentID),
        ]);
    }

    public function actionIndividual($courseCode = null)
    {
        if($courseCode == null && !$this->isInstructor()){
            $ctrAct = 'assignment/individual';
             $this->redirect(['/course/select','ctrAct' => $ctrAct]);
        }
        $searchModel = new AssignmentSearch();
        $dataProvider = $searchModel->searchIndividualAssignmentPending(Yii::$app->request->queryParams,$courseCode);
        
        return $this->render('/assignment/@assignment', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'title' => "Individual Assignments",
        ]);
    }

    public function actionGroup($courseCode = null)
    {
        if($courseCode == null && !$this->isInstructor()){
            $ctrAct = 'assignment/group';
             $this->redirect(['/course/select','ctrAct' => $ctrAct]);
        }

        $searchModel = new AssignmentSearch();
        $dataProvider = $searchModel->searchGroupAssignmentPending(Yii::$app->request->queryParams,$courseCode);

        return $this->render('/assignment/@assignment', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'title' => "Group Assignments",
        ]);
    }
    /**
     * Creates a new Assignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $isInstructor = User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor' ;
        if( !$isInstructor ){
            return  $this->redirect(['site/error']);
        }
        $model = new Assignment();
        $model->courseCode = Course::find()->where(['courseInstructor' => Instructor::find()->where(['UserID' => Yii::$app->user->getId()])->one()])->one()->courseCode;//Instructor::find()->where(['UserID' => Yii::$app->user->getId()])->one()->CourseCode;
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->status = 'Pending';
            $model->assignedDate = date('d-m-y h:i',time());
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Successfully Created Assignment.');
                return $this->redirect(['view', 'AssignmentID' => $model->AssignmentID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Assignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $AssignmentID Assignment ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($AssignmentID, $StudentID = null)
    {

        $model = $this->findModel($AssignmentID);
        $model->assignedDate = date('d-m-y h:i',time());

        if($model->status == 'Assigned'){
            Yii::$app->session->setFlash('error', 'Assigned Assignments cant be Updated');
            return $this->redirect(['view', 'AssignmentID' => $model->AssignmentID]);
                }
        if ($this->request->isPost) {

            $model->load($this->request->post());
            $model->file = \yii\web\UploadedFile::getInstance($model, 'file');

            if ($model->file) {
                $model->upload();
            }

            if ($model->save()) {
                if ($StudentID != null) {
                    
                    $SubmissionExist = Submission::find()->where(['AssignmentID' => $AssignmentID, 'StudentID' => $StudentID])->one();
                    if ($SubmissionExist) {


                    } else {
                        $SubmissionModel = new Submission();

                        $SubmissionModel->AssignmentID = $model->AssignmentID;
                        $SubmissionModel->SubmissionStatus = 'Not Marked';
                        $SubmissionModel->SubmissionContent = $model->AssignmentContent;
                        $SubmissionModel->fileURL = $model->fileURL;
                        $SubmissionModel->StudentID = $StudentID;
                    }
                }else{
                    Yii::$app->session->setFlash('Success', 'Assignment Updated Successfully');
                    return $this->redirect(['view', 'AssignmentID' => $model->AssignmentID]);
                }
               
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }



    public function actionSubmit($AssignmentID, $StudentID = null)
    {
        $AssignmentModel = $this->findModel($AssignmentID);

        if ($this->request->isPost) {
            $AssignmentModel->load($this->request->post());
            if ($StudentID != null) {

                $SubmissionModel = Submission::find()->where(['AssignmentID' => $AssignmentID, 'StudentID' => $StudentID])->one();
                if (!$SubmissionModel) {

                    $SubmissionModel = new Submission(); 
                }
                    if($AssignmentModel->save()){
                    
                    $SubmissionModel->AssignmentID = $AssignmentModel->AssignmentID;
                    $SubmissionModel->AssignmentStatus = 'Submitted';
                    $SubmissionModel->SubmissionStatus = 'Not Marked';
                    $SubmissionModel->SubmissionContent = $AssignmentModel->AssignmentContent;
                    $SubmissionModel->fileURL = $AssignmentModel->fileURL;
                    $SubmissionModel->StudentID = $StudentID;

                    if($SubmissionModel->save()){
                        Yii::$app->session->setFlash('Success', 'Assignment Submitted Successfully');
                        //return $this->goBack();

                        $AssignmentModel->AssignmentContent = null;
                        $AssignmentModel->fileURL = null;

                        if($AssignmentModel->save()){
                            return $this->goBack();
                        }
                    }

                    }

               

            }else{
            $AssignmentModel->status = 'Assigned';
            if($AssignmentModel->save()){
                return $this->render('view', [
                    'model' => $AssignmentModel,
                ]);
            }
            }

            
        }

        return $this->render('View', [
            'model' => $AssignmentModel,
        ]);

    }

    public function actionDo($AssignmentID,$StudentID = null,$Submit = false)
    {
        $model = $this->findModel($AssignmentID);
       
        $SubmissionModel = Submission::find()->where(['AssignmentID' => $AssignmentID,'StudentID' => $StudentID])->one();
        if ($StudentID != null && $SubmissionModel) {
            

            if($SubmissionModel->AssignmentStatus == 'Submitted' ){

                Yii::$app->session->setFlash('danger', 'Submitted Assignment Cant\'t be Edited.');
                return $this->redirect(['view', 'AssignmentID' => $model->AssignmentID]);
            }
            //throw new NotFoundHttpException('The requested page does not exist.');
            $model->AssignmentContent = $SubmissionModel->SubmissionContent;
            $model->fileURL = $SubmissionModel->fileURL;
        }

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            // Get the uploaded file instance
            $model->file = \yii\web\UploadedFile::getInstance($model, 'file');

            // Validate and save the model
            if ($model->validate()) {
                if ($model->file) {
                    // Delete the existing file, if any
                    if ($model->fileURL) {
                        unlink(Yii::getAlias('@webroot') . '/attachments/' . $model->fileURL);
                    }

                    // Generate a unique filename
                    $fileName = 'prefix_' . time() . '.' . $model->file->extension;

                    // Move the uploaded file to a directory
                    $model->file->saveAs(Yii::getAlias('@webroot/attachments/') . $fileName);

                    // Save the filename to the model attribute
                    $model->fileURL = $fileName;
                }

                if ($model->save()) {
                    
                    if($StudentID != null){
                        if(!$SubmissionModel){
                         $SubmissionModel = new Submission();

                        }
                        $SubmissionModel->AssignmentID = $model->AssignmentID;
                        $SubmissionModel->PreScore = 0;
                        $SubmissionModel->fileURL = $model->fileURL;
                        $SubmissionModel->StudentID = $StudentID;
                        $SubmissionModel->submissionDate = date('Y-m-d H:m');
                        $SubmissionModel->AssignmentStatus = $Submit ? 'Submitted': 'Pending';
                        $SubmissionModel->SubmissionContent = $model->AssignmentContent;

                        $SubmissionModel->SubmissionStatus = 'Not Marked';
                    if($SubmissionModel->save()){
                        //$this->findModel($AssignmentID)->delete();
                        $model->AssignmentContent = null;
                        $model->fileURL = null;

                        if($model->save()){
                             // Model saved successfully
                            Yii::$app->session->setFlash('success', $Submit ? 'Assignment Submitted Successfully':'Successfully Saved Assignment.');
                            return $this->redirect(['view', 'AssignmentID' => $model->AssignmentID]);
                        }
                       
                    
                    }else{
// Model saved successfully
                    Yii::$app->session->setFlash('error', 'Failed to Save Assignment.');
                    return $this->refresh('#');
                    }
                    }
                    
                }
            }
        }


        return $this->render('do', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Assignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $AssignmentID Assignment ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($AssignmentID)
    {
        $this->findModel($AssignmentID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Assignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $AssignmentID Assignment ID
     * @return Assignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($AssignmentID)
    {
        if (($model = Assignment::findOne(['AssignmentID' => $AssignmentID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
