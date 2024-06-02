<?php

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
<?php if(frontend\models\User::find()->where(['UserID' => yii::$app->user->id])->one()->role == 'student'): ?>
<div class="container">

    <h1 class="text-center"><?= $title?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
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


    <?php Pjax::end(); ?>

</div>

<?php else: ?>
    <div class="container">

<h1 class="text-center"><?= Html::encode($this->title) ?></h1>
<?php Pjax::begin(); ?>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
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


<?php Pjax::end(); ?>

</div>
    
<?php endif;?>