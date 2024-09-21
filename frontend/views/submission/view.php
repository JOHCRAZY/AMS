<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use frontend\models\User;
use frontend\models\{Course, Student, Group, Assignment};
use frontend\models\Instructor;

/** @var yii\web\View $this */
/** @var frontend\models\Submission $model */

$this->title = $model->assignment->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Submissions'), 'url' => ['submission/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$isInstructor = User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor';

$course = Course::findOne(['courseCode' => $model->getAssignment()->one()->courseCode]);
$courseName = $course->courseName ?? 'N/A';
$instructor = Instructor::findOne(['InstructorID' => $course->courseInstructor]);

?>

<div class="container-fluid mb-5">
    <div class="card shadow-lg mb-5 rounded-3 elevation-4 p-4" style="background: transparent">
        <div class="card-header">
            <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
        </div>
        <blockquote class="text-center rounded-5 pl-3 mt-2" style="background: transparent">
            <?php if($model->assignment->assignment == 'Group Assignment'): ?>
            <div class="row">
                <div class="col-sm-6">
                <p class="text-primary"><?= Html::encode($courseName) ?></p>
            <footer class="blockquote-footer">INSTRUCTOR :- 
                <cite title="Source Title"><?= Html::encode($instructor->fname . ' ' . $instructor->mname . ' ' . $instructor->lname) ?></cite>
            </footer>
                </div>
                <div class="col-sm-6 text-center">
        <?php    $courseCode = Assignment::find()
                                    ->where(['AssignmentID' => $model->assignment->AssignmentID])->one()->courseCode;
                    $group = Group::find()
                                    ->where(['StudentID' => $model->student->StudentID, 'courseCode' => $courseCode])->one();

                    $GroupMember = Student::find()
                                    ->where(['IN','StudentID',
                                    Group::find()->select('StudentID')
                                    ->where(['GroupNO' => $group->GroupNO, 'courseCode' => $courseCode])])->all();
                    $students = '';
                    foreach($GroupMember as $student){

                 $students .= '<p>
                <footer class="blockquote-footer"> <strong>'.$student->fname.' '.$student->lname.'</strong> => REG NO:
                    <cite title="Source Title">' . Html::encode($student->regNo) . '</cite>
                </footer></p>';

                    }

                    echo '<p class="text-primary">'.$group->groupName.'</p>'.$students;
                ?>

        </div>
            </div>

            <?php else: ?>
                <p class="text-primary"><?= Html::encode($courseName) ?></p>
            <footer class="blockquote-footer">INSTRUCTOR :- 
                <cite title="Source Title"><?= Html::encode($instructor->fname . ' ' . $instructor->mname . ' ' . $instructor->lname) ?></cite>
            </footer>
            <?php endif; ?>
        </blockquote>
        <div class="row">
            <div class="col-4">
                <p><i class="fas fa-book"></i> <strong>Course Code:</strong> <?= Html::encode($model->assignment->courseCode) ?></p>
            </div>
            <div class="col-4">
                <p><i class="fas fa-user-graduate"></i> <strong><?= Html::encode($model->assignment->assignment == 'Group Assignment' ? 'Submitted By' : 'Student Name') ?>:</strong> <?= Html::encode($model->student->fname . ' ' . $model->student->lname) ?></p>
            </div>
            <div class="col-4">
                <p><i class="fas fa-id-badge"></i> <strong>Student Reg. No:</strong> <?= Html::encode($model->student->regNo) ?></p>
            </div>
            
            <div class="col-4">
                <p><i class="fas fa-calendar-alt"></i> <strong>Date Submitted:</strong> <?= Yii::$app->formatter->asDatetime($model->submissionDate) ?></p>
            </div>
            <div class="col-4">
                <p><i class="fas fa-paperclip"></i> 
                <strong>Attached File:</strong> 
                <?= !empty($model->fileURL) ? Html::a('View Attachment', 
                        [Yii::$app->request->baseUrl.'/attachments/'.$model->fileURL], 
                        ['class' => 'btn btn-link','target' => '_blank']) : 'No file Attached' ?></p>
            </div>
            <div class="col-4">
                <p><i class="fas fa-check-circle"></i> <strong>Submission Status:</strong> 
                <?= $model->SubmissionStatus == 'Marked' ? ('<span class="text-success">Marked</span>') : ('<span class="text-danger">Not Marked</span>'); ?>
                </p>
            </div>
            <div class="col-4">
            <?php $placeholder = '<span class="text-danger">-:- -:-</span>'; ?>
                <p><i class="fas fa-percent"></i> <strong>Score:</strong> <?= $model->score ?? $placeholder ?></p>
            </div>
            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-percent"></i>
                                    <strong>Out of:</strong> <?= Html::encode($model->assignment->marks) ?>
                                </p>
                            </div>
        </div>

        <?php if ($isInstructor && $model->SubmissionStatus !== 'Marked'): ?>
            <div class="card-footer text-center">
                <?php $form = ActiveForm::begin(['action' => ['mark', 'SubmissionID' => $model->SubmissionID], 'method' => 'post']) ?>
                    <?= Html::submitButton(Yii::t('app', 'Mark Assignment'), ['class' => 'btn btn-outline-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-12">
                <p><i class="fas fa-file-alt"></i> <strong>Student Work:</strong></p>
                <div class="submission-content">
                    <?= $model->SubmissionContent ?>
                </div>
            </div>
</div>
