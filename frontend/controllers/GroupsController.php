<?php

namespace frontend\controllers;

use frontend\controllers\GroupMembers;
use frontend\controllers\StudentInfo;
use frontend\controllers\StudentList;
use frontend\models\Course;
use frontend\models\Group;
use frontend\models\GroupForm;
use frontend\models\Groups;
use frontend\models\Instructor;
use frontend\models\Student;
use frontend\models\User;use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\WindowController;

class GroupsController extends Controller
{
    use WindowController;
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

    protected function isInstructor()
    {
        return User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor';

    }

    protected static function getStudent()
    {
        $user = User::findByUsername(Yii::$app->user->identity->username);
        return Student::find()->where(['UserID' => $user->UserID])->one();
    }

    protected static function getInstructor()
    {
        $user = User::findByUsername(Yii::$app->user->identity->username);
        return Instructor::find()->where(['UserID' => $user->UserID])->one();
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

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionCreate()
    {
        $course = Course::find()->where(['courseInstructor' => Instructor::find()->where(['UserID' => Yii::$app->user->getId()])->one()])->one();

        $model = new GroupForm();
        if (!$this->isInstructor()) {

            throw new NotFoundHttpException(Yii::t('app', 'You\'re Not allowed to perform this action.'));
        }

        $students = Student::find()
        // ->joinWith('programmeCode0')
            ->where(['IN', 'Student.programmeCode',
                Course::find()
                    ->select('Course.programmeCode')
                    ->where(['courseName' => $course->courseName]),
            ])
            ->andWhere(['Student.year' => $course->year,'Student.semester' => $course->semester])
            ->all();

        $Groups = Group::find()
            ->joinWith('courseCode0')
            ->where(['Course.courseCode' => $course->courseCode])
            ->groupBy(['groupName', 'GroupNO'])
            ->all();

        $studentsWithNoGroups = Student::find()
            ->where(['IN', 'Student.programmeCode',
                Course::find()
                    ->select('Course.programmeCode')
                    ->where(['courseName' => $course->courseName]),
            ])
            ->andWhere(['NOT IN', 'StudentID',
                Group::find()
                    ->select('StudentID')
                    ->where(['courseCode' => $course->courseCode]),
            ])
            ->andWhere(['Student.year' => $course->year,'Student.semester' => $course->semester])           
            ->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Save group data to the database
            foreach ($model->StudentIDs as $StudentID) {

                $group = new Group();
               // $group->GroupID = time() + random_int(50,100);
                $group->StudentID = $StudentID;
                $group->courseCode = $course->courseCode;
                $group->GroupNO = $model->groupNO;
                $group->groupName = $model->groupName;

                if ($group->save()) {

                   //continue;

                } else {

                    throw new NotFoundHttpException(Yii::t('app', 'Operations failed to save.'));
                }

            }

            Yii::$app->session->setFlash('success', $group->groupName . ' Created Successfully.');
            return $this->refresh();
        }

        StudentList::ShowStudentList($students, $Groups, $course->courseName);

        return $this->render('create', [
            'model' => $model,
            'students' => $studentsWithNoGroups,
            'Groups' => $Groups,
        ]);
    }

    public function actionInfo($StudentID)
    {

        if (!$this->isInstructor()) {

            throw new NotFoundHttpException(Yii::t('app', 'You\'re Not allowed to perform this action.'));

        }
        StudentInfo::ShowStudentInfo($StudentID);

        return $this->render('info');

    }

    public function actionMembers($courseCode = null, $GroupID = null)
    {

        if ($courseCode == null && !$this->isInstructor()) {
            $ctrAct = 'groups/members';
            return $this->redirect(['/course/select', 'ctrAct' => $ctrAct]);
        }

        if (!$this->isInstructor()) {
            $courseName = Course::find()
                ->where(['courseCode' => $courseCode])->one()->courseName;

            $group = Group::find()
                ->where(['StudentID' => self::getStudent()->StudentID, 'courseCode' => $courseCode])->one();

            if ($group == null) {

                //throw new NotFoundHttpException(Yii::t('app', '(' . $courseName . ') You\'re Not Assigned to Any Group in This Course.'));

                Yii::$app->session->setFlash('error',' You\'re Not Assigned to Any Group in This Course'.' (' . $courseName . ')');
                return $this->goBack();
            }
            $groupNO = $group->GroupNO;
            $groupName = Group::find()
                ->where(['StudentID' => self::getStudent()->StudentID, 'courseCode' => $courseCode])->one()->groupName;

            $studentIDs = Group::find()
                ->select('StudentID')
                ->where(['GroupNO' => $groupNO, 'courseCode' => $courseCode])->all();

            $students = Student::find()
                ->where(['IN', 'StudentID', $studentIDs])->all();

            GroupMembers::ShowGroupMembers($students, $courseName, $groupName, $groupNO, true);
            return $this->render('info');
        }

           $course = Course::find()
                ->where(['courseInstructor' => self::getInstructor()->InstructorID])->one();

            $group = Group::find()
                ->where(['GroupID' => $GroupID, 'courseCode' => $course->courseCode])->one();
            $groupNO = $group->GroupNO;
            $groupName = Group::find()
                ->where(['GroupID' => $GroupID, 'courseCode' => $course->courseCode])->one()->groupName;

            $studentIDs = Group::find()
                ->select('StudentID')
                ->where(['GroupNO' => $groupNO, 'courseCode' => $course->courseCode])->all();

            $students = Student::find()
                ->where(['IN', 'StudentID', $studentIDs])->all();

            GroupMembers::ShowGroupMembers($students, $course->courseName, $groupName, $groupNO, true);
            return $this->render('info');
    }

}
