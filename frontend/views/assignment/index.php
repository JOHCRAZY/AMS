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
?>
<div class="container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
<div class="row justify-content-center">
<?= $isInstructor ? Html::a(Yii::t('app', 'Create New Assignment'), ['create'], ['class' => 'btn btn-lg btn-primary mt-4 mb-1 w-50']) : null?>

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
            'courseCode',
            'assignment',
            'title',
           // 'content:ntext',
           // 'description:html',
            //'fileURL',
            'assignedDate',
            'submissionDate',
            'marks',
            [
                'attribute' => 'status',
                'value' => function ($model) use($isInstructor){
                    if(!$isInstructor && $model->status == 'Assigned'){

                        $assignment = frontend\models\Submission::find()->where(['AssignmentID' => $model->AssignmentID])->one();

                        if($assignment != null && $assignment->AssignmentStatus == 'Submitted'){

                            return 'Submitted';
                        }
                       
                    else{
                        return 'New';
                        //return Url::toRoute([$action, 'AssignmentID' => $model->AssignmentID]);
                    }
                    }
                    return $model->status;
                 },
        
             ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Assignment $model, $key, $index, $column) {
                    if($model->status == 'Assigned'){
                        $assignment = frontend\models\Submission::find()->where(['AssignmentID' => $model->AssignmentID])->one();
                        if($assignment != null && $assignment->AssignmentStatus == 'Submitted'){

                            return null;
                        }
                       
                    else{
                        return Url::toRoute([$action, 'AssignmentID' => $model->AssignmentID]);
                    }
                    }
                 },
                 'template' => $isInstructor ? '{view} {update}' : '{view}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
