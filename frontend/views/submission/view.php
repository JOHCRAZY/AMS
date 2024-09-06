<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use frontend\models\User;
use frontend\models\Course;
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
    <div class="card custom-card shadow-lg mb-5 rounded-3 elevation-4 p-4">
        <div class="card-header">
            <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
        </div>
        <blockquote class="text-center rounded-5 pl-3 mt-2">
            <p><?= Html::encode($courseName) ?></p>
            <footer class="blockquote-footer">INSTRUCTOR :- 
                <cite title="Source Title"><?= Html::encode($instructor->fname . ' ' . $instructor->mname . ' ' . $instructor->lname) ?></cite>
            </footer>
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
                <p><i class="fas fa-paperclip"></i> <strong>Attached File:</strong> <?= !empty($model->fileURL) ? Html::a('Download', ['download', 'id' => $model->SubmissionID], ['class' => 'btn btn-link']) : 'No file Attached' ?></p>
            </div>
            <div class="col-4">
                <p><i class="fas fa-check-circle"></i> <strong>Submission Status:</strong> 
                <?= $model->SubmissionStatus == 'Marked' ? ('<span class="text-success">Marked</span>') : ('<span class="text-danger">Not Marked</span>'); ?>
                </p>
            </div>
            <div class="col-4">
                <p><i class="fas fa-percent"></i> <strong>Score:</strong> <?= Html::encode($model->score) ?></p>
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
