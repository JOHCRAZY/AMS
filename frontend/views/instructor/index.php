<?php

use frontend\models\Instructor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\Instructors $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Instructors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instructor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'InstructorID',
            'fname',
            'mname',
            'lname',
            'UserID',
            //'emailAddress:email',
            //'phoneNumber',
            //'profileImage',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Instructor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'InstructorID' => $model->InstructorID]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
