<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Student $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userID')->textInput() ?>

    <?= $form->field($model, 'section')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'regNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emailAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'profileImage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'groupID')->textInput() ?>

    <?= $form->field($model, 'courseCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'programmeCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->dropDownList([ 'I' => 'I', 'II' => 'II', 'III' => 'III', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'semester')->dropDownList([ 'I' => 'I', 'II' => 'II', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
