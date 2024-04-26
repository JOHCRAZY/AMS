<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Instructors $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="instructor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'InstructorID') ?>

    <?= $form->field($model, 'fname') ?>

    <?= $form->field($model, 'mname') ?>

    <?= $form->field($model, 'lname') ?>

    <?= $form->field($model, 'UserID') ?>

    <?php // echo $form->field($model, 'emailAddress') ?>

    <?php // echo $form->field($model, 'phoneNumber') ?>

    <?php // echo $form->field($model, 'profileImage') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
