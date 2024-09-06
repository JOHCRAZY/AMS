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
$programme = \frontend\models\Programme::find()->all();//->select(['programmeCode'])->indexBy('programmeCode')->column();


?>
<div class="container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'courseCodes' => $courses,
        'programme' => $programme,
        'update' => false,
    ]) ?>

</div>

