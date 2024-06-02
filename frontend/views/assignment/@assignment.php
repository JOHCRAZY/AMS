<?php

use frontend\models\Assignment;
use frontend\models\Submission;
//use yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\AssignmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $title */

$this->title = Yii::t('app', $title);
$this->params['breadcrumbs'][] = $this->title;
$isInstructor = frontend\models\User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor' ;
?>
<div class="container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?php $isInstructor ?  Html::a(Yii::t('app', 'Create Assignment'), ['create'], ['class' => 'btn btn-success']) : null?>
    </p>

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
            //'content:ntext',
            //'description:html',
            //'fileURL',
            'assignedDate:datetime',
            'submissionDate:datetime',
            'marks',
            $isInstructor ? 'status' : 'status',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Assignment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'AssignmentID' => $model->AssignmentID]);
                 },
                 'template' => $isInstructor ?  '{view} {update}' : '{view}',
            ] 
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
