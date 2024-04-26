<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Submission $model */

$this->title = $model->SubmissionID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Submissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="submission-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'SubmissionID' => $model->SubmissionID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'SubmissionID' => $model->SubmissionID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'SubmissionID',
            'AssignmentID',
            [
                'attribute' => 'assignment.courseCode',
                'label' => 'Assignment', // Optionally, you can specify a custom label for the attribute
            ],
            'groupID',
            'StudentID',
            'content:ntext',
            'submissionDate',
            'fileURL',
            'status',
            'score',
        ],
    ]) ?>

</div>
