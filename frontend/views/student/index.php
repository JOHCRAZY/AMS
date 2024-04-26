<?php

use frontend\models\Student;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\students $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Students');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fname',
            'lname',
            'regNo',
            'emailAddress:email',
            'programmeCode',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Student $model, $key, $index, $column) {

                    return Url::toRoute([$action, 'StudentID' => $model->StudentID]);
                 },
                 'template' => '{view}',

            ],
        ],
    ]); ?>


</div>
