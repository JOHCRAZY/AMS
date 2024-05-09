<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Instructor $model */

$this->title = Yii::t('app', 'Update Instructor: {name}', [
    'name' => $model->InstructorID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instructors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->InstructorID, 'url' => ['view', 'InstructorID' => $model->InstructorID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="instructor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
