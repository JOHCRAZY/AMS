<?php

use backend\models\Student;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\Students $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'All Students');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
<!-- 
    <p>
        < ?= Html::a(Yii::t('app', 'Create Student'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'StudentID',
            'fname',
            //'mname',
            'lname',
            //'userID',
            //'session',
            'regNo',
            //'phoneNumber',
            //'emailAddress:email',
            'gender',
            //'profileImage',
            //'programmeCode',
            'year',
            //'semester',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Student $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'StudentID' => $model->StudentID]);
                 },
                 'template' => '{view}{update}',

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
