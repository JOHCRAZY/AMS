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
$programme = \frontend\models\Programme::find()->all()//->select(['programmeCode'])->indexBy('programmeCode')->column();
?>
<div class="container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'courseCodes' => $courses,
        'programme' => $programme,
    ]) ?>

</div>
