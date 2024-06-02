<?php

use backend\models\Course;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\Courses $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'All Courses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">

    <!-- <p>
        < ?= Html::a(Yii::t('app', 'Create Course'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'courseName',
           // 'courseCode',
            //'semester',
           // 'year',
            [
                'attribute'=> 'Course Instructor',
                'format'=> 'text',
                'value'=> function ($model){
                    $instructor = \backend\models\Instructor::findOne(['InstructorID' => $model->courseInstructor]);
                    if($instructor){
                        return $instructor->fname. ' ' .$instructor->lname;
                    }
                }
            ],
            'programmeCode',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Course $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'courseCode' => $model->courseCode]);
                 },
                 'template' => '{view}{update}',

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
