<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;


/** @var yii\web\View $this */
/** @var backend\models\Student $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="card w-100 p-5 m-2 rounded-3 justify-content-center border-secondary">


    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data',
        ],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-8 text-danger\">{error}</div>",
            'labelOptions' => ['class' => 'col-sm-0 control-label'],
        ],
    ]); ?>

<br><br>
 <span class="row">
 <div class="col-sm-6 mb-3 mb-sm-0">
    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
 </div>
 <div class="col-sm-6 mb-3 mb-sm-0">
    <?= $form->field($model, 'mname')->textInput(['maxlength' => true]) ?>
 </div>
 <div class="col-sm-6 mb-3 mt-4 mb-sm-0">
    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
 </div>
    </span>

   <br>

<span class="row">
<div class="col-sm-6 mb-3 mb-sm-0">
<?= $form->field($model, 'emailAddress')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-sm-6 mb-3 mb-sm-0">
<?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => true]) ?>

</div>
<div class="col-sm-6 mb-3 mt-4 mt-2 mb-sm-0">
<?= $form->field($model, 'regNo')->textInput(['maxlength' => true]) ?>
</div>
</span>
<br><br>
<span class="row mt-3">
<div class="col-sm-3 mb-3 mb-sm-0">
<?= $form->field($model, 'gender')->widget(Select2::class, [
        'data' => ['Male' => 'Male', 'Female' => 'Female'],
        'options' => ['placeholder' => 'Select gender ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
</div>
<div class="col-sm-3 mb-3 mb-sm-0">
<?= $form->field($model, 'session')->widget(Select2::class, [
        'data' => ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E'],
        'options' => ['placeholder' => 'Select session ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
</div>

<div class="col-sm-6 mb-3 mb-sm-0">
<?= $form->field($model, 'programmeCode')->widget(Select2::class, [
        'data' => \yii\helpers\ArrayHelper::map($programme, 'programmeCode', 'programmeName'),
        'options' => ['placeholder' => 'Select a programme...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
</div>
</span>
<br><br>
<span class="row">
    <div class="col-sm-6 mb-3 mb-sm-0">
    <?= $form->field($model, 'year')->widget(Select2::class, [
        'data' => ['I' => 'I', 'II' => 'II', 'III' => 'III'],
        'options' => ['placeholder' => 'Select year ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    </div>
    <div class="col-sm-6 mb-3 mb-sm-0">
    <?= $form->field($model, 'semester')->widget(Select2::class, [
        'data' => ['I' => 'I', 'II' => 'II'],
        'options' => ['placeholder' => 'Select semester ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    </div>
</span>
   


    

    <br><br>

    <div class="d-flex justify-content-end">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-outline-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

