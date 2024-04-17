<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Submission $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="submission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'assignmentID')->textInput() ?>

    <?= $form->field($model, 'groupID')->textInput() ?>

    <?= $form->field($model, 'StudentID')->textInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'submissionDate')->textInput() ?>

    <?= $form->field($model, 'fileURL')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
