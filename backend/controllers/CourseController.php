<?php

namespace backend\controllers;

use backend\models\Course;
use backend\models\Instructor;
use backend\models\Courses;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
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
     * Lists all Course models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new Courses();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Course model.
     * @param string $courseCode Course Code
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($courseCode)
    {
        return $this->render('view', [
            'model' => $this->findModel($courseCode),
        ]);
    }

    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Course();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $instructor = Instructor::findOne(['InstructorID' => $model->courseInstructor]);
                $instructor->Status = 'Verified';
                $instructor->save(false);
                return $this->redirect(['view', 'courseCode' => $model->courseCode]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $courseCode Course Code
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($courseCode)
    {
        $model = $this->findModel($courseCode);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $instructor = Instructor::findOne(['InstructorID' => $model->courseInstructor]);
                $instructor->Status = 'Verified';

                $instructor->save(false);
            return $this->redirect(['view', 'courseCode' => $model->courseCode]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $courseCode Course Code
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($courseCode)
    {
        $this->findModel($courseCode)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $courseCode Course Code
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($courseCode)
    {
        if (($model = Course::findOne(['courseCode' => $courseCode])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
