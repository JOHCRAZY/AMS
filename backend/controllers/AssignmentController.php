<?php

namespace backend\controllers;

use backend\models\Assignment;
use backend\models\Assignments;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AssignmentController implements the CRUD actions for Assignment model.
 */
class AssignmentController extends Controller
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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
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
        $searchModel = new Assignments();
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'AssignmentID' => $model->AssignmentID]);
        }

        return $this->render('update', [
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
