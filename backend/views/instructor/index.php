<?php

use backend\models\Instructor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\Instructors $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'All Instructors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instructor-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        < ?= Html::a(Yii::t('app', 'Create Instructor'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'InstructorID',
            'fname',
            //'mname',
            'lname',
           //'UserID',
            'emailAddress:email',
            //'phoneNumber',
            //'profileImage',
            'Status',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Instructor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'InstructorID' => $model->InstructorID]);
                 },
                 'template' => '{view}{update}',

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
