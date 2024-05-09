<?php

namespace frontend\controllers;

use frontend\models\Course;
use frontend\models\CourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\bootstrap5\Modal;
use frontend\models\Student;
use frontend\controllers\Selector;

include_once('Selector.php');
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
       $student =  Student::find()->where(['userID' => \Yii::$app->user->id])->one();
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, $student->semester,$student->year,$student->programmeCode);

        //$modalContent = 
        //renderModal($dataProvider);
       //echo $modalContent;
        Selector::SelectCourse($dataProvider);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSelect($ctrAct)
    {
       $student =  Student::find()->where(['userID' => \Yii::$app->user->id])->one();
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, $student->semester,$student->year,$student->programmeCode);

        Selector::SelectCourse($dataProvider,$ctrAct);
       return $this->render('select');

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

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }


    protected function selectCourse($dataProvider)
    {
        // HTML for the modal content
        $modalContent = '<div class="modal fade" id="courses" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Select Course</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-grid gap-2 col-4 w-100">';
        // HTML for the modal body with course links
        foreach ($dataProvider->models as $course) {
            $modalContent .= Html::a($course->courseName, ['course/view', 'courseCode' => $course->courseCode], ['class' => 'btn btn-outline-primary', 'data-dismiss' => 'modal']);
        }
        $modalContent .= '</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
    
        // JavaScript to trigger the modal on page load
        $triggerScript = '<script type="text/javascript">
                            document.addEventListener("DOMContentLoaded", function() {
                                var myModal = new bootstrap.Modal(document.getElementById("courses"));
                                myModal.show();
                            });
                          </script>';
    
        // Combine modal content HTML and JavaScript trigger
        $modal = $modalContent . $triggerScript;
    
        // Directly return the combined HTML
        return $modal;
    }
}
