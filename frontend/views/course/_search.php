<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\CourseSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="course-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'courseCode') ?>

    <?= $form->field($model, 'courseName') ?>

    <?= $form->field($model, 'semester') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'courseInstructor') ?>

    <?php // echo $form->field($model, 'programmeCode') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
