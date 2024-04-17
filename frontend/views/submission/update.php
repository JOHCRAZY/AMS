<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Submission $model */

$this->title = Yii::t('app', 'Update Submission: {name}', [
    'name' => $model->SubmissionID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Submissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SubmissionID, 'url' => ['view', 'SubmissionID' => $model->SubmissionID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="submission-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
