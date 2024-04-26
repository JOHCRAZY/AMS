<?php

use frontend\models\Course;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var frontend\models\Student $model */

$this->title = Yii::t('app', yii::$app->user->identity->username);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Students'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;

$courses = Course::find()->select(['courseCode','courseName'])->indexBy('courseCode')->column();
$programmeCodes = \frontend\models\Programme::find()->select(['programmeCode'])->indexBy('programmeCode')->column();

// Assuming $courses is the result of your database query
// $courseCodes = ArrayHelper::map($courses, 'id', function(Courses) {
//     return [
//         'name' => $model->course_name,
//         'title' => $model->course_title,
//     ];
// });

?>
<div class="student-profile">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'courseCodes' => $courses,
        'programmeCodes' => $programmeCodes,
    ]) ?>

</div>

