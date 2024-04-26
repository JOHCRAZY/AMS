<?php

use frontend\models\Assignment;
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
$isInstructor = yii::$app->user->identity->role == 'instructor';
?>
<div class="assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php $isInstructor ?  Html::a(Yii::t('app', 'Create Assignment'), ['create'], ['class' => 'btn btn-success']) : null?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'AssignmentID',
            'courseCode',
            [
                'attribute'=>'Course.CourseName',
                'label'=>Yii::t('app','Course Name'),
            ],
            'assignment',
            'title',
            //'content:ntext',
            'description:ntext',
            //'fileURL',
            'assignedDate',
            'submissionDate',
            'marks',
            'status',
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