<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\Submission;
use yii\web\NotFoundHttpException;
use frontend\models\SubmissionSearch;
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
                            'actions' => ['index', 'view', 'create', 'update', 'delete','individual-not-marked','group-marked','group-not-marked','individual-marked'],
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


    public function actionIndividualMarked(){
        $searchModel = new SubmissionSearch();
        $dataProvider = $searchModel->searchIndividualMarked(Yii::$app->request->queryParams);

        return $this->render('/submission/@assignment',[
           'dataProvider'=>$dataProvider,
           'searchModel'=>$searchModel,
           'title' =>  "Marked Individual Assignments"
        ]);
    }

    public function actionIndividualNotMarked(){
        $searchModel = new SubmissionSearch();
        $dataProvider = $searchModel->searchIndividualNotMarked(Yii::$app->request->queryParams);

        return $this->render('/submission/@assignment',[
           'dataProvider'=>$dataProvider,
           'searchModel'=>$searchModel,
           'title' =>  "Individual Assignments"
        ]);
    }

    public function actionGroupMarked(){
        $searchModel = new SubmissionSearch();
        $dataProvider = $searchModel->searchGroupMarked(Yii::$app->request->queryParams);

        return $this->render('/submission/@assignment',[
           'dataProvider'=>$dataProvider,
           'searchModel'=>$searchModel,
           'title' =>  "Marked Group Assignments"
        ]);
    }

    public function actionGroupNotMarked(){
        $searchModel = new SubmissionSearch();
        $dataProvider = $searchModel->searchGroupNotMarked(Yii::$app->request->queryParams);

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
