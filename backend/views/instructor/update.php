<?php


/** @var yii\web\View $this */
/** @var backend\models\Instructor $model */
/** @var backend\models\Course $Courses[] */

$this->title = Yii::t('app', 'Update |  {name}', [
    'name' => $model->fname. ' '.$model->lname,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instructors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fname. ' '.$model->lname, 'url' => ['view', 'InstructorID' => $model->InstructorID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="instructor-update">

    <?= $this->render('_form', [
        'model' => $model,
        'Courses' => $Courses
    ]) ?>

</div>
