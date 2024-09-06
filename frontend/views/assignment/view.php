<?php

use yii\helpers\Html;
use frontend\models\User;
use frontend\models\Course;
use frontend\models\Instructor;

/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */

$this->title = $model->title;
$isInstructor = User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' =>  ['assignment/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$course = Course::findOne(['courseCode' => $model->courseCode]);
$courseName = $course->courseName ?? 'N/A';
$instructor = Instructor::findOne(['InstructorID' => $course->courseInstructor]);
$isInstructor = Instructor::findOne(['UserID' => Yii::$app->getUser()->id]);
$status = null;
?>

<div class="container-fluid mb-5">
    <div class="card custom-card shadow-lg mb-5 rounded-3 elevation-4 p-4">
        <div class="card-header">
            <h2 class="text-center"><?= Html::encode($model->title) ?></h2>
        </div>
        <blockquote class="text-center rounded-5 pl-3 mt-2">
            <p><?= Html::encode($courseName) ?></p>
            <footer class="blockquote-footer">INSTRUCTOR :- 
                <cite title="Source Title"><?= Html::encode($instructor->fname . ' ' . $instructor->mname . ' ' . $instructor->lname) ?></cite>
            </footer>
        </blockquote>

        <div class="row">
            <div class="col-4">
                <p><i class="fas fa-book"></i> <strong>Course Code:</strong> <?= Html::encode($model->courseCode) ?></p>
            </div>
            <div class="col-4">
                <p><i class="fas fa-tasks"></i> <strong>Assignment Type:</strong> <?= Html::encode($model->assignment) ?></p>
            </div>
            <div class="col-4">
                <p><i class="fas fa-calendar-alt"></i> <strong>Assigned Date:</strong> <?= $model->status !== 'Assigned' ? ('<span class="text-danger"> -:- -:- </span>') : Yii::$app->formatter->asDatetime($model->assignedDate) ?></p>
            </div>
            <div class="col-4">
                <p><i class="fas fa-percent"></i> <strong>Marks:</strong> <?= Html::encode($model->marks) ?></p>
            </div>
            <div class="col-4">

                <?php if ($isInstructor): ?>
    <p><i class="fas fa-check-circle"></i> <strong>Status:</strong> 
    <?= $model->status == 'Assigned' ? '<span class="text-success">Assigned</span>' : '<span class="text-danger">Pending</span>' ?></p>
<?php else: ?>
    <?php
    $student = frontend\models\Student::find()->where(['userID' => Yii::$app->user->identity->getId()])->one();
    
    if ($student) {
        $submission = frontend\models\Submission::find()->where(['AssignmentID' => $model->AssignmentID, 'StudentID' => $student->StudentID])->one();
        
        if ($submission) {
            $status = $submission->AssignmentStatus;
            ?>
            <p><i class="fas fa-check-circle"></i> <strong>Status:</strong> 
            <?= $status !== 'Pending' ? '<span class="text-success">Submitted</span>' : '<span class="text-danger">Pending</span>' ?></p>
            <?php
        } else {
            ?>
            <p><i class="fas fa-check-circle"></i> <strong>Status:</strong> <span class="text-danger">Assignment not Attempted</span></p>
            <?php
        }
    } else {
       
        ?>
        <p><i class="fas fa-check-circle"></i> <strong>Status:</strong> <span class="text-danger">Student Not Found</span></p>
        <?php
    }
    ?>
<?php endif; ?>
            </div>
            <div class="col-4">
                <p><i class="fas fa-calendar-check"></i> <strong>Submission Date / Deadline:</strong> <?= Yii::$app->formatter->asDatetime($model->submissionDate) ?></p>
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="text-center">
                    <?php if ($isInstructor): ?>

                        <?php if($model->status !== 'Assigned'): ?>

                        <?= Html::a(Yii::t('app', 'Update Assignment'), ['update', 'AssignmentID' => $model->AssignmentID], ['class' => 'btn btn-outline-primary']) ?>
                        <?php else: ?>
                            <?= Html::a(Yii::t('app', 'View Students submitted this assignment'), ['submission/mark-individual', 'AssignmentID' => $model->AssignmentID], ['class' => 'btn btn-outline-primary']) ?>
                        <?php endif; ?>
                            <?php elseif($status): ?>
                    <?php else: ?>
                        <?= Html::a(Yii::t('app', 'Take Assignment'), ['do', 'AssignmentID' => $model->AssignmentID, 'StudentID' => frontend\models\Student::find()->where(['userID' => Yii::$app->user->id])->one()->StudentID], ['class' => 'btn btn-outline-primary']) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="col-10">
            <p><i class="fas fa-align-left"></i> <strong>Assignment: </strong> <?= ($model->description) ?></p>
        </div>
    </div>
</div>
