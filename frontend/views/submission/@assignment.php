<?php

use frontend\models\Submission;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\SubmissionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Submissions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="submission-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Submission'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SubmissionID',
            'AssignmentID',
            'groupID',
            'StudentID',
            [
                'attribute' => 'student.regNo',
                'label' => Yii::t('app', 'Reg No'),
                'value' => function ($model) {
                    return $model->student->regNo;
                },
            ],
            'content:ntext',
            'submissionDate',
            //'fileURL',
            'status',
            'score',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Submission $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'SubmissionID' => $model->SubmissionID]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
