<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Student $model */

$this->title = Yii::t('app', '{name}', [
    'name' => $model->fname. " ". $model->lname,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fname, 'url' => ['view', 'StudentID' => $model->StudentID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');


$courses = \frontend\models\Course::find()->select(['courseCode','courseName'])->indexBy('courseCode')->column();
$programmeCodes = \frontend\models\Programme::find()->select(['programmeCode'])->indexBy('programmeCode')->column();
?>
<div class="student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'courseCodes' => $courses,
        'programmeCodes' => $programmeCodes,
    ]) ?>

</div>
