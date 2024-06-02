<?php

namespace backend\controllers;

use backend\models\{Group,Student,Course};
use backend\models\Groups;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupController implements the CRUD actions for Group model.
 */
class GroupController extends Controller
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
     * Lists all Group models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new Groups();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Group model.
     * @param int $GroupID Group ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($GroupID)
    {
        return $this->render('view', [
            'model' => $this->findModel($GroupID),
        ]);
    }

    /**
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    // public function actionCreate()
    // {
    //     $model = new Group();

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {
    //             return $this->redirect(['view', 'GroupID' => $model->GroupID]);
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    // public function actionCreate()
    // {
    //     //$course = Course::find()->where(['courseInstructor' => Instructor::find()->where(['UserID' => Yii::$app->user->getId()])->one()])->one();

    //     $model = new Group();
    //     $students = Student::find()
    //     // ->joinWith('programmeCode0')
    //         ->where(['IN', 'Student.programmeCode',
    //             Course::find()
    //                 ->select('Course.programmeCode')
    //                 ->where(['courseName' => $course->courseName]),
    //         ])
    //         ->andWhere(['Student.year' => $course->year,'Student.semester' => $course->semester])
    //         ->all();

    //     $Groups = Group::find()
    //         ->joinWith('courseCode0')
    //         ->where(['Course.courseCode' => $course->courseCode])
    //         ->groupBy(['groupName', 'GroupNO'])
    //         ->all();

    //     $studentsWithNoGroups = Student::find()
    //         ->where(['IN', 'Student.programmeCode',
    //             Course::find()
    //                 ->select('Course.programmeCode')
    //                 ->where(['courseName' => $course->courseName]),
    //         ])
    //         ->andWhere(['NOT IN', 'StudentID',
    //             Group::find()
    //                 ->select('StudentID')
    //                 ->where(['courseCode' => $course->courseCode]),
    //         ])
    //         ->andWhere(['Student.year' => $course->year,'Student.semester' => $course->semester])           
    //         ->all();

    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         // Save group data to the database
    //         foreach ($model->StudentIDs as $StudentID) {

    //             $group = new Group();
    //             $group->GroupID = time() + 1;
    //             $group->StudentID = $StudentID;
    //             $group->courseCode = $course->courseCode;
    //             $group->GroupNO = $model->groupNO;
    //             $group->groupName = $model->groupName;

    //             if ($group->save()) {

    //                 continue;

    //             } else {

    //                 throw new NotFoundHttpException(Yii::t('app', 'Operations failed to save.'));
    //             }

    //         }

    //         Yii::$app->session->setFlash('success', $group->groupName . ' Created Successfully.');
    //         return $this->refresh();
    //     }

    //     StudentList::ShowStudentList($students, $Groups, $course->courseName);

    //     return $this->render('create', [
    //         'model' => $model,
    //         'students' => $studentsWithNoGroups,
    //         'Groups' => $Groups,
    //     ]);
    // }

    /**
     * Updates an existing Group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $GroupID Group ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($GroupID)
    {
        $model = $this->findModel($GroupID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'GroupID' => $model->GroupID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Group model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $GroupID Group ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($GroupID)
    {
        $this->findModel($GroupID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $GroupID Group ID
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($GroupID)
    {
        if (($model = Group::findOne(['GroupID' => $GroupID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}
