<?php

namespace frontend\controllers;

use frontend\models\Instructor;
use frontend\models\Instructors;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;

/**
 * InstructorController implements the CRUD actions for Instructor model.
 */
class InstructorController extends Controller
{
    //public $layout = 'instructor';
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
                            'actions' => ['index', 'view', 'profile', 'update'],
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
     * Lists all Instructor models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new Instructors();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Instructor model.
     * @param int $InstructorID Instructor ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($InstructorID)
    {
        return $this->render('view', [
            'model' => $this->findModel($InstructorID),
        ]);
    }

    /**
     * Creates a new Instructor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionProfile()
    {
        // Check if an instructor record already exists for the current user
    //$existingInstructor = Instructor::findOne(['UserID' => Yii::$app->user->identity->id]);
    $existingInstructor = Instructor::find()
    ->joinWith('user')
    ->where([
        'Instructor.UserID' => Yii::$app->user->identity->id,
        'User.role' => 'instructor', // Assuming the column name is 'role' in the user table
    ])
    ->one();


    // If an instructor record already exists, redirect to the view action
    if ($existingInstructor !== null) {
        return $this->redirect(['view', 'InstructorID' => $existingInstructor->InstructorID]);
    }

        $instructor = new Instructor();
        $instructor->UserID = Yii::$app->user->identity->id;
        if ($this->request->isPost) {
            $instructor->load($this->request->post());
            $instructor->imageFile = \yii\web\UploadedFile::getInstance($instructor, 'imageFile');

            if($instructor->imageFile){
                $instructor->upload();
            }
            if ($instructor->save()) {
                return $this->redirect(['view', 'InstructorID' => $instructor->InstructorID]);
            }
        } else {
            $instructor->loadDefaultValues();
        }

        return $this->render('profile', [
            'model' => $instructor,
        ]);
    }

    /**
     * Updates an existing Instructor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $InstructorID Instructor ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($InstructorID)
    {
        $model = $this->findModel($InstructorID);

        if ($this->request->isPost){
         $model->load($this->request->post());
         $model->imageFile = \yii\web\UploadedFile::getInstance($model, 'imageFile');

         if ($model->imageFile) {
            $model->upload();
        }
         if($model->save()) {
            return $this->redirect(['view', 'InstructorID' => $model->InstructorID]);
        }
    }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Instructor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $InstructorID Instructor ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($InstructorID)
    {
        $this->findModel($InstructorID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Instructor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $InstructorID Instructor ID
     * @return Instructor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($InstructorID)
    {
        if (($model = Instructor::findOne(['InstructorID' => $InstructorID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
