<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Students $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'StudentID') ?>

    <?= $form->field($model, 'fname') ?>

    <?= $form->field($model, 'mname') ?>

    <?= $form->field($model, 'lname') ?>

    <?= $form->field($model, 'userID') ?>

    <?php // echo $form->field($model, 'session') ?>

    <?php // echo $form->field($model, 'regNo') ?>

    <?php // echo $form->field($model, 'phoneNumber') ?>

    <?php // echo $form->field($model, 'emailAddress') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'profileImage') ?>

    <?php // echo $form->field($model, 'programmeCode') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'semester') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
