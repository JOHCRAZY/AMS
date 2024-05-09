<?php

namespace backend\controllers;

use backend\models\Programme;
use backend\models\Programmes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;

/**
 * ProgrammeController implements the CRUD actions for Programme model.
 */
class ProgrammeController extends Controller
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
     * Lists all Programme models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new Programmes();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Programme model.
     * @param string $programmeCode Programme Code
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($programmeCode)
    {
        return $this->render('view', [
            'model' => $this->findModel($programmeCode),
        ]);
    }

    /**
     * Creates a new Programme model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Programme();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'programmeCode' => $model->programmeCode]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Programme model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $programmeCode Programme Code
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($programmeCode)
    {
        $model = $this->findModel($programmeCode);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'programmeCode' => $model->programmeCode]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Programme model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $programmeCode Programme Code
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($programmeCode)
    {
        $this->findModel($programmeCode)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Programme model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $programmeCode Programme Code
     * @return Programme the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($programmeCode)
    {
        if (($model = Programme::findOne(['programmeCode' => $programmeCode])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
