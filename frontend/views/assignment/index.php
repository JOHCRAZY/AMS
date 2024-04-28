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

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'AssignmentID',
            'courseCode',
            'assignment',
            'title',
           // 'content:ntext',
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
                 'template' => $isInstructor ? '{view} {update}' : '{view}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
