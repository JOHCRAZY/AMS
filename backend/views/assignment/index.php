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

$this->title = Yii::t('app', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-index">

    <!-- <h1>< ?= Html::encode($this->title) ?></h1> -->

    <!-- <p>
        < ?= Html::a(Yii::t('app', 'Create Assignment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'assignment',
            'title',
            'assignedDate',
            'submissionDate',
            'marks',
            'courseCode',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Assignment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'AssignmentID' => $model->AssignmentID]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
