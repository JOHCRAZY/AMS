<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var frontend\models\SubmissionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $title */

$this->title = Yii::t('app', 'Submitted Assignment');
$this->params['breadcrumbs'][] = $this->title;

$isStudent = frontend\models\User::find()->where(['UserID' => yii::$app->user->id])->one()->role == 'student';
?>

<h1 class="text-center"><?= Html::encode($this->title) ?></h1>

<div class="container-fluid mb-5">
    <?php Pjax::begin(); ?>
    <div class="row">
        <?php foreach ($dataProvider->models as $model): ?>
            <?php
            $course = frontend\models\Course::findOne(['courseCode' => $model->assignment->courseCode]);
            $instructor = frontend\models\Instructor::findOne(['InstructorID' => $course->courseInstructor]);
            ?>
            <div class="col-sm-4 mb-3">
                <div class="card custom-card shadow-sm elevation-4" style="min-width: 15rem;">
                    <div class="card-header">
                        <h3 class="text-center"><?= Html::encode($model->assignment->title) ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-book"></i>
                                    <strong>Course:</strong> <?= Html::encode($course ? $course->courseName : 'N/A') ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">
                                    <?php if($isStudent): ?>
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <strong>Instructor: </strong> <?= Html::encode($instructor ? $instructor->fname . ' ' . $instructor->lname : 'Not Set') ?>
                                    <?php else: ?>
                                        <i class="fas fa-user"></i>
                                        <?php 
                                        $student = $model->getStudent()->one();
                                        ?>
                                        <strong>Student: </strong> <?= Html::encode($student ? $student->fname . ' ' . $student->lname : 'Not Set') ?>
                                        <?php endif; ?>

                                </p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-calendar-alt"></i>
                                    <strong>Assigned:</strong> <?= Yii::$app->formatter->asDatetime($model->assignment->assignedDate) ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-calendar-check"></i>
                                    <strong>Due:</strong> <?= Yii::$app->formatter->asDatetime($model->assignment->submissionDate) ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-percent"></i>
                                    <strong>Score:</strong> <?= Html::encode($model->score) ?>
                                    <strong>Out of:</strong> <?= Html::encode($model->assignment->marks) ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-percent"></i>
                                    <strong>Out of:</strong> <?= Html::encode($model->assignment->marks) ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-calendar-check"></i>
                                    <strong>Date Submitted:</strong> <?= Yii::$app->formatter->asDatetime($model->submissionDate) ?>
                                </p>
                            </div>
                            
                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-check-circle"></i>
                                    <strong>Status:</strong> <?= $model->SubmissionStatus == 'Marked' ? ('<span class="text-success">Marked</span>') : ('<span class="text-danger">Pending</span>'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-around">
                        <?= Html::a('<i class="fas fa-eye"></i> View', ['view', 'SubmissionID' => $model->SubmissionID], ['class' => 'btn btn-outline-primary']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php Pjax::end(); ?>
</div>

<style>
.custom-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    background: #fff;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.custom-card:hover {
    transform: translate(-2px,-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card-title {
    color: #343a40;
    font-weight: bold;
}

.card-text {
    margin-bottom: 0.5rem;
    color: #6c757d;
}

.card-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.card-footer .btn {
    font-size: 0.875rem;
}
</style>


<!-- < ?php

use frontend\models\Submission;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\SubmissionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $title */

$this->title = Yii::t('app', 'Submitted Assignment');
$this->params['breadcrumbs'][] = $this->title;
?>
< ?php if(frontend\models\User::find()->where(['UserID' => yii::$app->user->id])->one()->role == 'student'): ?>
<div class="container-fluid">

    <h1 class="text-center">< ?= $title?></h1>
    < ?php Pjax::begin(); ?>
    < ?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    < ?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

       // 'SubmissionID',
        [
            //'attribute' => 'assignmentID',
            'label' => 'Assignment Title',
            'value' => function ($model) {
                return $model->assignment->title; 
            },
        ],
        [
            'attribute' => 'Course Name',
            'value' => function ($model) {
                return frontend\models\Course::find()->where(['courseCode' => $model->assignment->courseCode])->one()->courseName; 
                        },
        ],
        [
            'attribute' => ' Instructor ',
            'value' => function ($model) {

                $instructorID =  frontend\models\Course::find()->where(['courseCode' => $model->assignment->courseCode])->one()->courseInstructor; 
                $instructor = \frontend\models\Instructor::find()->where(['InstructorID' => $instructorID])->one();

                if($instructor){
                    return $instructor->fname. ' ' .$instructor->lname;
                }else{
                    return 'Not Set';
                }
            },

        ],
        
        [
            'attribute' => 'Assigned Date',
            'value' => function ($model) {
                return $model->assignment->assignedDate; 
            },
        ],
        [
            'attribute' => 'Deadline',
            'value' => function ($model) {
                return $model->assignment->submissionDate; 
            },
        ],
        [
            'attribute' => 'submissionDate',
            'label' => 'Date Submitted'
        ],
        
        [
            'attribute' => 'SubmissionStatus',
            'label' => 'Status'
        ],
        [
            'attribute' => 'Total Marks',
            'value' => function ($model) {
                return $model->assignment->marks; // Assuming group_name is the attribute you want to display
            },
        ],
        [
            'attribute' => 'score',
            'label' => 'Score'
        ],
        [
            'class' => ActionColumn::class,
            'urlCreator' => function ($action, Submission $model, $key, $index, $column) {
                return Url::toRoute([$action, 'SubmissionID' => $model->SubmissionID]);
            },
            'template' => '{view}'
        ],
    ],
]); ?>


    < ?php Pjax::end(); ?>

</div>

< ?php else: ?>
    <div class="container-fluid">

<h1 class="text-center">< ?= Html::encode($this->title) ?></h1>
< ?php Pjax::begin(); ?>
< ?php // echo $this->render('_search', ['model' => $searchModel]); ?>

< ?= GridView::widget([
'dataProvider' => $dataProvider,
'filterModel' => $searchModel,
'columns' => [
    ['class' => 'yii\grid\SerialColumn'],

    [
        'attribute' => 'Student Reg No.',
        'value' => function ($model) {
            return $model->student->regNo;; // Assuming student_name is the attribute you want to display
        },
    ],
    [
        'attribute' => 'Course Name',
        'value' => function ($model) {
            return frontend\models\Course::find()->where(['courseCode' => $model->assignment->courseCode])->one()->courseName; // Assuming group_name is the attribute you want to display
        },
    ],
    [
        //'attribute' => 'assignmentID',
        'label' => 'Assignment Title',
        'value' => function ($model) {
            return $model->assignment->title; // Assuming assignment_name is the attribute you want to display
        },
    ],
    
    [
        'attribute' => 'Assigned Date',
        'format' => 'datetime',
        'value' => function ($model) {
            return $model->assignment->assignedDate; // Assuming group_name is the attribute you want to display
        },
    ],
    [
        'attribute' => 'Deadline',
        'format' => 'datetime',
        'value' => function ($model) {
            return $model->assignment->submissionDate; // Assuming group_name is the attribute you want to display
        },
    ],
    [
        'attribute' => 'submissionDate',
        'label' => 'Date Submitted',
        'format' => 'datetime',
    ],
    
    [
        'attribute' => 'SubmissionStatus',
        'label' => 'Assignment Status'
    ],
    [
        'attribute' => 'Total Marks',
        'value' => function ($model) {
            return $model->assignment->marks; // Assuming group_name is the attribute you want to display
        },
    ],
    [
        'attribute' => 'score',
        'label' => 'Student Score'
    ],
    [
        'class' => ActionColumn::class,
        'urlCreator' => function ($action, Submission $model, $key, $index, $column) {
            return Url::toRoute([$action, 'SubmissionID' => $model->SubmissionID]);
        },
        'template' => '{view}'
    ],
],
]); ?>


< ?php Pjax::end(); ?>

</div>
    
< ?php endif;?> -->