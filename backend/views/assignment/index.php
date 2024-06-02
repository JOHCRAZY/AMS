<?php

use backend\models\Assignment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\Assignments $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'All Assignments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
<!-- 
    <p>
        < ?= Html::a(Yii::t('app', 'Create Assignment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'AssignmentID',
            'courseCode',
            'assignment',
            'title',
            //'AssignmentContent:ntext',
            //'description:ntext',
            //'fileURL',
            'assignedDate:datetime',
            'submissionDate:datetime',
            //'marks',
            //'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Assignment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'AssignmentID' => $model->AssignmentID]);
                 },
                 'template' => '{view}{update}',

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
