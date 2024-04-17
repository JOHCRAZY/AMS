<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Assignment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'courseCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assignment')->dropDownList([ 'Individual Assignment' => 'Individual Assignment', 'Group Assignment' => 'Group Assignment', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fileURL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assignedDate')->textInput() ?>

    <?= $form->field($model, 'submissionDate')->textInput() ?>

    <?= $form->field($model, 'marks')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Pending' => 'Pending', 'Submitted' => 'Submitted', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
