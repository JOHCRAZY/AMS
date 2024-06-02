<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Assignments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="assignment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'AssignmentID') ?>

    <?= $form->field($model, 'courseCode') ?>

    <?= $form->field($model, 'assignment') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'AssignmentContent') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'fileURL') ?>

    <?php // echo $form->field($model, 'assignedDate') ?>

    <?php // echo $form->field($model, 'submissionDate') ?>

    <?php // echo $form->field($model, 'marks') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
