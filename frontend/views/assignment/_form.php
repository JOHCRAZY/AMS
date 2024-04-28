<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<<div class="assignment-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'courseCode')->widget(\kartik\select2\Select2::class, [
    'data' => frontend\models\Course::find()->select(['courseCode','courseName'])->indexBy('courseCode')->column(),
    'options' => ['placeholder' => 'Select course code'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

<?= $form->field($model, 'assignment')->widget(\kartik\select2\Select2::class, [
    'data' => ['Individual Assignment' => 'Individual Assignment', 'Group Assignment' => 'Group Assignment'],
    'options' => ['placeholder' => 'Select assignment type'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'fileURL')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'assignedDate')->widget(\kartik\datetime\DateTimePicker::class, [
    'options' => ['placeholder' => 'Enter assigned date ...'],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd hh:ii:ss'
    ]
]); ?>

<?= $form->field($model, 'submissionDate')->widget(\kartik\datetime\DateTimePicker::class, [
    'options' => ['placeholder' => 'Enter submission date ...'],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd hh:ii:ss'
    ]
]); ?>

<?= $form->field($model, 'marks')->textInput() ?>

<?= $form->field($model, 'status')->dropDownList(['Pending' => 'Pending', 'Submitted' => 'Submitted'], ['prompt' => 'Select status']); ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>

