<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\GroupForm;
use frontend\models\Student;
use frontend\models\Course;
use frontend\controllers\{StudentList,StudentInfo};
class GroupsController extends Controller
{
    public function actionCreate($StudentID = null)
    {
        $model = new GroupForm();
        $students = Student::find()->all();
        $courses = Course::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Save group data to the database
            foreach ($model->groups as $group) {
                // Process $group to create each group and associated students
            }
            // Redirect or show success message
        }

        // Set default number of groups to create
        if (empty($model->groups)) {
            $model->groups = [
                ['GroupNO' => 1, 'groupName' => 'group name', 'StudentIDs' => []], // Default group
            ];
        }

        StudentList::ShowStudentList($students);
        // StudentInfo::ShowStudentInfo(4);
        // if($StudentID != null){
        //     StudentInfo::ShowStudentInfo($StudentID);
        //     //return $this->redirect('student/info');

        // }
        return $this->render('create', [
            'model' => $model,
            'students' => $students,
            'courses' => $courses,
        ]);
    }

    public function actionInfo($StudentID){

        StudentInfo::ShowStudentInfo($StudentID);

        return $this->render('info');


    }

    public function actionStudents(){

        $students = Student::find()->all();

        StudentList::ShowStudentList($students);

        return $this->render('info');
    }

}
?>

<?php

namespace frontend\controllers;

use frontend\models\Group;
use frontend\models\Groups;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupsController implements the CRUD actions for Group model.
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
    public function actionCreate()
    {
        $model = new Group();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'GroupID' => $model->GroupID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

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
