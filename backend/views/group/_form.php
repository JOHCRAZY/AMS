<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var frontend\models\Group $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card rounded-5 p-5 m-5">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'groupName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'groupNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudentIDs')->widget(Select2::class, [
    'data' => \yii\helpers\ArrayHelper::map($students, 'StudentID', function ($student) {
        return $student['fname'] .' '. $student['lname'] . ' - ' . $student['regNo'];
    }),
    'options' => ['placeholder' => 'Select students...', 'multiple' => true],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
