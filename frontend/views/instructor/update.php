<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Instructor $model */

$this->title = Yii::t('app', '{name}', [
    'name' => $model->fname. " ". $model->lname,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instructors'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = ['label' => $model->fname, 'url' => ['view', 'InstructorID' => $model->InstructorID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <center class="mb-lg-2 p-xl-5">
    <img src="<?= Yii::$app->request->baseUrl.'/profiles/'.$model->profileImage ?>" class="rounded-4 img-circle elevation-2 pull-right" style="width: 70px;">

</center>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
