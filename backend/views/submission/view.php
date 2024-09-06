<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Submission $model */

$this->title = $model->SubmissionID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Submissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="submission-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'SubmissionID',
           // 'AssignmentID',
           // 'groupID',
            //'StudentID',
            'content:ntext',
            'submissionDate:date',
            'fileURL',
            'status',
            'score',
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'SubmissionID' => $model->SubmissionID], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'SubmissionID' => $model->SubmissionID], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
