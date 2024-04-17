<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Course $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'courseCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'courseName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'InstructorID')->textInput() ?>

    <?= $form->field($model, 'programmeCode')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
