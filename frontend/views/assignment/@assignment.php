<?php

use frontend\models\Assignment;
use frontend\models\Submission;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\AssignmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $title */

$this->title = Yii::t('app',$title);
$this->params['breadcrumbs'][] = $this->title;
$isInstructor = frontend\models\User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor' ;



$user = frontend\models\User::findByUsername(\Yii::$app->user->identity->username);
$student = frontend\models\Student::find()->where(['UserID' => $user->UserID])->one();


?>

<!-- <h1 class="text-center">< ?= Html::encode($this->title) ?></h1> -->

<div class="container-fluid mb-5">
    <?php Pjax::begin(); ?>
    <div class="row">
        <?php if(empty($dataProvider->models)): ?>
            <div class="text-center p-5 m-5">
            <i class="fas fa-tasks fa-10x text-muted"></i>
            <p class="mt-5 text-muted"><h5>No <?= $this->title ?> yet.</h5></p>
        </div>
        <?php else: ?>
        <?php foreach ($dataProvider->models as $model): ?>
            <?php
            $course = frontend\models\Course::findOne(['courseCode' => $model->courseCode]);
            $isSubmitted = !$isInstructor && $model->status == 'Assigned' && frontend\models\Submission::find()->where(['AssignmentID' => $model->AssignmentID, 'StudentID' => $student->StudentID, 'AssignmentStatus' => 'Submitted'])->exists();
            //$course = frontend\models\Course::findOne(['courseCode' => $model->assignment->courseCode]);
            $instructor = frontend\models\Instructor::findOne(['InstructorID' => $course->courseInstructor]);
            ?>
            <div class="col-md-4">
                <div class="card custom-card shadow-sm elevation-4" style="min-width: 20rem;">
                    <div class="card-header">
                        <h3 class="text-center"><?= Html::encode($model->title) ?></h2>
                    </div>
                    <div class="card-body">


                        <div class="row">
                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-book"></i>
                                    <strong>Course Code:</strong> <?= Html::encode($course ? $course->courseCode : 'N/A') ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-calendar-alt"></i>
                                    <strong>Assigned date:</strong> <?= $model->status !== 'Assigned' ? ('<span class="text-danger"> -:- -:- </span>') : Yii::$app->formatter->asDatetime($model->assignedDate) ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-tasks"></i>
                                    <strong>Assignment:</strong> <?= Html::encode($model->assignment) ?>
                                </p>
                            </div>

                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-calendar-check"></i>
                                    <strong>Due:</strong> <?= Yii::$app->formatter->asDatetime($model->submissionDate) ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-percent"></i>
                                    <strong>Total Marks:</strong> <?= Html::encode($model->marks) ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="card-text">
                                    <i class="fas fa-check-circle"></i>
                                    <strong>Status:</strong>
                                    <?php
                                    if (!$isInstructor) {
                                        echo $isSubmitted ? ('<span class="text-success">Submitted</span>') : ('<span class="text-danger">Pending</span>');
                                    } else {
                                        echo $model->status == 'Assigned' ? ('<span class="text-success">Assigned</span>') : ('<span class="text-danger">Pending</span>');
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                        <blockquote class="text-center rounded-5 pl-3 mt-2">
                            <p>
                                <?= Html::encode($course ? $course->courseName : 'N/A') ?>
                            </p>
                            <footer class="blockquote-footer m-0">Lecture - <cite title="Source Title"><?= Html::encode($instructor->fname.' '.$instructor->mname.' '.$instructor->lname) ?></cite></footer>
                        </blockquote>
                    </div>
                    <div class="card-footer d-flex justify-content-around">
                        <?= Html::a('<i class="fas fa-eye"></i> View', ['view', 'AssignmentID' => $model->AssignmentID], ['class' => 'btn btn-outline-primary']) ?>
                        <?php if ($isInstructor && $model->status !== 'Assigned'): ?>
                            <?= Html::a('<i class="fas fa-edit"></i> Update', ['update', 'AssignmentID' => $model->AssignmentID], ['class' => 'btn btn-outline-secondary']) ?>

                        <?php endif; ?>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php Pjax::end(); ?>
</div>

<style>
    .custom-card {
        border: 1px solid paleturquoise;
        border-radius: 10px;
        background: #fff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .custom-card:hover {
        transform: translate(-2px, -5px);
        box-shadow: 0 4px 8px rgba(2, 4, 6, 0.2);
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
        /* border-top: 1px solid #e9ecef; */
    }

    .card-footer .btn {
        font-size: 0.875rem;
    }
</style>
<!-- 
// ? >
// <div class="container">


//     <h1 class="text-center">< ?= Html::encode($this->title) ? ></h1>

//     <p>
//         < ?php $isInstructor ?  Html::a(Yii::t('app', 'Create Assignment'), ['create'], ['class' => 'btn btn-success']) : null? >
//     </p>

//     < ?php Pjax::begin(); ? >
//     < ?= GridView::widget([
//         'dataProvider' => $dataProvider,
//         'filterModel' => $searchModel,
//         'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

//             //'AssignmentID',
//             [
//                 'attribute' => 'Course Name',
//                 'value' => function ($model) {
//                     return frontend\models\Course::find()->where(['courseCode' => $model->courseCode])->one()->courseName; // Assuming group_name is the attribute you want to display
//                 },
//             ],
//             'courseCode',
//             'assignment',
//             'title',
//             //'content:ntext',
//             //'description:html',
//             //'fileURL',
//             'assignedDate:datetime',
//             'submissionDate:datetime',
//             'marks',
//             $isInstructor ? 'status' : 'status',
//             [
//                 'class' => ActionColumn::class,
//                 'urlCreator' => function ($action, Assignment $model, $key, $index, $column) {
//                     return Url::toRoute([$action, 'AssignmentID' => $model->AssignmentID]);
//                  },
//                  'template' => $isInstructor ?  '{view} {update}' : '{view}',
//             ] 
//         ],
//     ]); ? >

//     < ?php Pjax::end(); ? >

// </div> -->
