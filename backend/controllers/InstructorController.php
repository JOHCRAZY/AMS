<?php

namespace backend\controllers;

use backend\models\Instructor;
use backend\models\Instructors;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Course;
use Yii;

/**
 * InstructorController implements the CRUD actions for Instructor model.
 */
class InstructorController extends Controller
{
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
    public function actionCreate()
    {
        $model = new Instructor();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'InstructorID' => $model->InstructorID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
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
        $Courses = Course::find()->all();
        $model->Course = $model->Status == 'Verified' ? Course::find()->where(['courseInstructor' => $model->InstructorID])->one()->courseName : null;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            if($model->Course != null){

                $courseExisting = Course::find()->where(['courseInstructor' => $model->CourseInstructorID])->one();
                if($courseExisting != null) {

                    $courseExisting->courseInstructor = null;
                    $courseExisting->save();
                }
                $courseUpdate = Course::findOne(['courseCode' => $model->Course]);
                $courseUpdate->courseInstructor = $model->CourseInstructorID;

                
                if($courseUpdate->save()){

                    return $this->render('view', ['model' => $model,'InstructorID' => $model->InstructorID]);
                }else{
                    return $this->refresh();

                }
            }
            

        }

        return $this->render('update', [
            'model' => $model,
            'Courses' => $Courses,
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
