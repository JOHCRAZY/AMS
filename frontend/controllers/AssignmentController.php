<?php

namespace frontend\controllers;

use frontend\models\Assignment;
use frontend\models\AssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;

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
                            'actions' => ['index', 'view', 'create', 'update', 'group','individual','do'],
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
     * Lists all Assignment models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AssignmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

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

    public function actionIndividual(){
        $searchModel = new AssignmentSearch();
        $dataProvider = $searchModel->searchIndividualAssignmentPending(Yii::$app->request->queryParams);

        return $this->render('/assignment/@assignment',[
           'dataProvider'=>$dataProvider,
           'searchModel'=>$searchModel,
           'title' =>  "Individual Assignments"
        ]);
    }

    public function actionGroup(){
        $searchModel = new AssignmentSearch();
        $dataProvider = $searchModel->searchGroupAssignmentPending(Yii::$app->request->queryParams);

        return $this->render('/assignment/@assignment',[
           'dataProvider'=>$dataProvider,
           'searchModel'=>$searchModel,
           'title' =>  "Group Assignments"
        ]);
    }
    /**
     * Creates a new Assignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Assignment();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
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
    public function actionUpdate($AssignmentID)
    {
        $model = $this->findModel($AssignmentID);
        // $assignment = Assignment::findOne($AssignmentID);
        // if ($assignment->user_id !== Yii::$app->user->id) {
        //     throw new \yii\web\ForbiddenHttpException('You are not allowed to update this assignment.');
        // }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'AssignmentID' => $model->AssignmentID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDo($AssignmentID)
    {
        $model = $this->findModel($AssignmentID);
    
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'AssignmentID' => $model->AssignmentID]);
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
