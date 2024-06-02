<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var backend\models\Course $model */
/** @var yii\widgets\ActiveForm $form */
/** @var [] $instructors */
/** @var $programme */
?>

<div class="card p-4 m-3 rounded-4">

    <?php $form = ActiveForm::begin(); ?>

    <span class="row">
        <div class="col-sm-6">
        <?= $form->field($model, 'courseCode')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-6">
        <?= $form->field($model, 'courseName')->textInput(['maxlength' => true]) ?>
        </div>
    </span>

    <br>
    <span class="row">
        <div class="col-sm-6">
        <?= $form->field($model, 'year')->dropDownList([ 'I' => 'I', 'II' => 'II', 'III' => 'III', ], ['prompt' => '']) ?>

        </div>
        <div class="col-sm-6">
        <?= $form->field($model, 'semester')->dropDownList([ 'I' => 'I', 'II' => 'II', ], ['prompt' => '']) ?>

        </div>
    </span>
<br>
<span class="row">

<div class="col-sm-6 mb-3 mb-sm-0">
<?= $form->field($model, 'programmeCode')->widget(Select2::class, [
        'data' => \yii\helpers\ArrayHelper::map($programme, 'programmeCode', 'programmeName'),
        'options' => ['placeholder' => 'Select a programme...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
</div>
    <div class="col-sm-6 mb-3 mb-sm-0">
<?= $form->field($model, 'courseInstructor')->widget(Select2::class, [
        'data' => \yii\helpers\ArrayHelper::map($instructors, 'InstructorID',function ($instructor) {
            return $instructor['fname'] .' - '. $instructor['lname'];
        }),
        'options' => ['placeholder' => 'Select Instructor...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
</div>
</span>
   
    <span class="m-3 p-2 d-flex justify-content-end">
        <div class="align-end">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-outline-success']) ?>
        </div>
    </span>

    <?php ActiveForm::end(); ?>

</div>
