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

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
