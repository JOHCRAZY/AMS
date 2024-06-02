<?php

use frontend\models\Assignment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\AssignmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'All Assignments');
$this->params['breadcrumbs'][] = $this->title;
$isInstructor = frontend\models\User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor' ;
$user = frontend\models\User::findByUsername(\Yii::$app->user->identity->username);
$student = frontend\models\Student::find()->where(['UserID' => $user->UserID])->one();
?>
<div class="container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
<div class="row justify-content-center">
<?= $isInstructor ? Html::a(Yii::t('app', 'Create New Assignment'), ['create'], ['class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-50']) : null?>

</div>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'AssignmentID',
            [
                'attribute' => 'Course Name',
                'value' => function ($model) {
                    return frontend\models\Course::find()->where(['courseCode' => $model->courseCode])->one()->courseName; // Assuming group_name is the attribute you want to display
                },
            ],
           // 'courseCode',
            'assignment',
            'title',
           // 'content:ntext',
           // 'description:html',
            //'fileURL',
            'assignedDate:datetime',
            'submissionDate:datetime',
            'marks',
            [
                'attribute' => 'status',
                'value' => function ($model) use($isInstructor,$student){

                    if(!$isInstructor && $model->status == 'Assigned'){

                        $assignment = frontend\models\Submission::find()->where(['AssignmentID' => $model->AssignmentID,'StudentID' => $student->StudentID])->one();

                        if($assignment != null && $assignment->AssignmentStatus == 'Submitted'){

                            return 'Submitted';
                        }
                       
                    else{
                        return 'Not Submitted';
                    }
                    }
                    return $model->status;
                 },
        
             ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Assignment $model, $key, $index, $column) use ($isInstructor,$student) {
                    if(!$isInstructor && $model->status == 'Assigned'){

                        $assignment = frontend\models\Submission::find()->where(['AssignmentID' => $model->AssignmentID,'StudentID' => $student->StudentID])->one();
                        if($assignment != null && $assignment->AssignmentStatus == 'Submitted'){

                            return null;
                            //return Url::toRoute([$action, 'AssignmentID' => $model->AssignmentID]);
                        }
                       
                    else{
                        return Url::toRoute([$action, 'AssignmentID' => $model->AssignmentID]);
                    }
                    }else{
                        return Url::toRoute([$action, 'AssignmentID' => $model->AssignmentID]);

                    }
                 },
                 'template' => $isInstructor ? '{view} {update}' : '{view}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
