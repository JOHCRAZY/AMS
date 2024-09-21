<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var frontend\models\Student $model */
/** @var yii\widgets\ActiveForm $form */

/** @var [] $courseCodes */
/** @var $programme */
?>
<div class=" w-100 p-5 m-2 rounded-3 justify-content-center border-secondary">
<div class="row d-grid">


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


<div class="col align-self-start">
<?= $form->field($model, 'imageFile')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'], // Accept only image files
        'pluginOptions' => [
            'showUpload' => false, // Hide the upload button
            'showRemove' => true, // Hide the remove button
            'initialPreview' => '<img src="'.Yii::$app->request->baseUrl."/profiles/".$model->profileImage.'" class="file-preview-image img-circle elevation-2 pull-right" style="width: 150px;">',
            // 'initialPreview' => isset($model->profileImage) ? Html::img($model->profileImage, ['class' => 'file-preview-image img-circle', 'style' => 'width: 150px; height: 150px;', 'alt' => 'Profile Image']) : null,
            'initialPreviewConfig' => [
                [
                    //'caption' => basename($model->profileImage),
                    'width' => '1200px', // Adjust the width as needed
                    //'url' => Yii::$app->urlManager->createUrl(['/controller/delete-profile-image']), // Action to delete the image
                    'key' => 0, // Use 0 if there's only one image
                ]
            ],
           'initialPreviewAsData' => true,
            'overwriteInitial' => true,
            //'browseClass' => 'btn btn-primary btn-block', // Bootstrap button style
            //'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' => 'Choose Profile Image', // Button label
        ]
    ]); ?>
</div>
<br><br>
<?php if(!$update): ?>
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

<!-- 'data' => \yii\helpers\ArrayHelper::map($dataProvider->models, 'courseCode', 'courseName'), -->
<div class="col-sm-6 mb-3 mb-sm-0">
<?= $form->field($model, 'programmeCode')->widget(Select2::class, [
        'data' => \yii\helpers\ArrayHelper::map($programme, 'programmeCode', 'programmeName'),////\yii\helpers\ArrayHelper::map($programme,'programmeCode','programmeName'),// $programmeCodes,
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
   


    <?php endif; ?>

    <br><br>

    <div class="d-flex justify-content-end">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-outline-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>