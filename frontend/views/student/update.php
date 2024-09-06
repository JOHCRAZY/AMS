<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Student $model */

$this->title = Yii::t('app', '{name}', [
    'name' => $model->fname. " ". $model->lname,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fname . ' ' .$model->lname, 'url' => ['view', 'StudentID' => $model->StudentID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');


$courses = \frontend\models\Course::find()->select(['courseCode','courseName'])->indexBy('courseCode')->column();
$programme = \frontend\models\Programme::find()->all()//->select(['programmeCode'])->indexBy('programmeCode')->column();
?>
<div class="container-fluid">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <center class="mb-lg-2 p-xl-5">
    <img src="<?= Yii::$app->request->baseUrl.'/profiles/'.$model->profileImage ?>" class="rounded-3 img-circle elevation-2 pull-right" style="width: 70px;">

</center>
    <?= $this->render('_form', [
        'model' => $model,
        'courseCodes' => $courses,
        'programme' => $programme,
        'update' => true, 
    ]) ?>

</div>
