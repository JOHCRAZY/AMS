<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Course $model */

// $this->title = Yii::t('app', 'Create Course');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Courses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$instructors = \backend\models\Instructor::find()->all();//select(['InstructorID','fname','lname'])->indexBy('InstructorID')->column();
$programme = \backend\models\Programme::find()->all()//->select(['programmeCode'])->indexBy('programmeCode')->column();
?>
<div class="course-create">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'instructors' => $instructors,
        'programme' => $programme,
    ]) ?>

</div>
