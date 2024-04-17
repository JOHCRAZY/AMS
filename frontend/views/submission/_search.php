<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\SubmissionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="submission-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'SubmissionID') ?>

    <?= $form->field($model, 'assignmentID') ?>

    <?= $form->field($model, 'groupID') ?>

    <?= $form->field($model, 'StudentID') ?>

    <?= $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'submissionDate') ?>

    <?php // echo $form->field($model, 'fileURL') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
