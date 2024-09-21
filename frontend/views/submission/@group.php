<?php
use frontend\models\{Submission, Assignment, Student,Group};
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\SubmissionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var frontend\models\Assignment $models */
/** @var string $AssignmentID */

$this->title = Yii::t('app', 'Submitted Group Assignments');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid mb-1">
    <div class="row gap-0">
    <div class="col-sm-6 assignments-title p-2">
    <?php
foreach ($models as $model): ?>
        <?=Html::a(
    '<blockquote class="rounded-1 m-2">
                <div class="container rounded-5 ' . ($model->AssignmentID == $AssignmentID ? "selected" : '') . '">
                    <p>' . Html::encode($model->title) . '</p>
                </div>
            </blockquote>',
    ['/submission/mark-group', 'AssignmentID' => $model->AssignmentID],
    ['class' => '', 'style' => 'text-decoration: none;']
);?>
    <?php endforeach;?>
</div>


        <div class="col-sm-6 students-list elevation-3 p-2" style="min-height: 830px; overflow-y: scroll;">

        <?php if (empty($dataProvider->models)): ?>
        <div class="text-center p-5 m-5">
            <i class="fas fa-user-graduate fa-10x text-muted"></i>
            <p class="mt-5 text-muted"><h5>No students have submitted this assignment yet.</h5></p>
        </div>
        <?php elseif ($AssignmentID == 1): ?>
        <div class="text-center p-5 m-5">
            <i class="fas fa-tasks fa-10x text-muted"></i>
            <p class="mt-3 text-muted"><h5>No assignment selected. Please select an assignment to view submissions.</h5></p>
        </div>
    <?php else: ?>
            <?php foreach ($dataProvider->models as $model): ?>
            <?php    $courseCode = Assignment::find()
                                    ->where(['AssignmentID' => $AssignmentID])->one()->courseCode;
                    $group = Group::find()
                                    ->where(['StudentID' => $model->student->StudentID, 'courseCode' => $courseCode])->one();

                    $GroupMember = Student::find()
                                    ->where(['IN','StudentID',
                                    Group::find()->select('StudentID')
                                    ->where(['GroupNO' => $group->GroupNO, 'courseCode' => $courseCode])])->all();
                    $students = '';
                    foreach($GroupMember as $student){

                 $students .= '<p>
                <footer class="blockquote-footer">REG NO:
                    <cite title="Source Title">' . Html::encode($student->regNo) . '</cite>
                </footer></p>';

                    }
                ?>
                    <?=Html::a(
    '<blockquote class="row justify-content-around rounded-5 m-1 elevation-4">
        <div class="col-sm-6 text-center">
            <h3 class="m-1">' . Html::encode($group->groupName) . '</h3>
            '.$students.'
        </div>
        <div class="col-sm-6 mt-1">
            <p class="card-text">
                <i class="fas fa-calendar-check"></i>
                <strong>Date Submitted:</strong> ' . Yii::$app->formatter->asDatetime($model->submissionDate) . '
            </p>
            <p class="card-text">
                <i class="fas fa-user-graduate"></i>
                <strong>Submitted BY:</strong> ' . Html::encode($model->student->regNo) . '
            </p>
            <p class="card-text">
                <i class="fas fa-check-circle"></i>
                <strong>Status:</strong> ' . ($model->SubmissionStatus == 'Marked' ? '<span class="text-success">Marked</span>' : '<span class="text-danger">Not Marked</span>') . '
            </p>
        </div>
    </blockquote>',
    ['/submission/view', 'SubmissionID' => $model->SubmissionID],
    ['class' => '', 'style' => 'text-decoration: none;']
);?>

            <?php endforeach; endif;?>
        </div>
    </div>
</div>

<style>
    .selected {
        color: white;
        text-align: center;
        font-weight: bold;
        background-color: teal;
        padding: 10px;
        border-radius: 10px;
    }
</style>
