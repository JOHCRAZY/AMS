<?php

namespace frontend\controllers;

use frontend\models\Student;
use frontend\models\students;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
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
                            'actions' => ['index', 'view', 'create', 'update', 'delete','profile'],
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

    /**
     * Lists all Student models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new students();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param int $StudentID Student ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($StudentID)
    {
        return $this->render('view', [
            'model' => $this->findModel($StudentID),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
  
    public function actionProfile()
    {

        $existingStudent = Student::find()
        ->joinWith('user')
        ->where([
            'Student.userID' => Yii::$app->user->identity->id,
            'User.role' => 'student', // Assuming the column name is 'role' in the user table
        ])
        ->one();
        if($existingStudent !== null){
            return $this->redirect(['view', 'StudentID' => $existingStudent->StudentID]);

        }

        $Student = new Student();
        $Student->userID = Yii::$app->user->identity->id;

        if ($this->request->isPost) {
            $Student->load($this->request->post());
            $Student->imageFile = \yii\web\UploadedFile::getInstance($Student, 'imageFile');
             if ($Student->imageFile) {
                 $Student->upload();
             }
            if ($Student->save()) {
                return $this->redirect(['view', 'StudentID' => $Student->StudentID]);
            }
        } else {
            $Student->loadDefaultValues();
        }

        return $this->render('profile', [
            'model' => $Student,
        ]);
    }


    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $StudentID Student ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($StudentID)
    {
        $model = $this->findModel($StudentID);

        if ($this->request->isPost){
            $model->load($this->request->post());
            $model->imageFile = \yii\web\UploadedFile::getInstance($model, 'imageFile');
             if ($model->imageFile) {
                 $model->upload();
             }
            if($model->save()) {
            return $this->redirect(['view', 'StudentID' => $model->StudentID]);
        }
    }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $StudentID Student ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($StudentID)
    {
        $this->findModel($StudentID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $StudentID Student ID
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($StudentID)
    {
        if (($model = Student::findOne(['StudentID' => $StudentID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
