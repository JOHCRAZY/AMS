<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var frontend\models\Student $model */
/** @var yii\widgets\ActiveForm $form */
/** @var bool $courseCodes */

$this->registerJs('
    $("#course-code, #programme-code").change(function(){
        var courseCode = $("#course-code").val();
        var programmeCode = $("#programme-code").val();
        $.ajax({
            url: "' . Url::to(['student/get-group-numbers']) . '",
            type: "GET",
            data: { courseCode: courseCode, programmeCode: programmeCode },
            success: function(data) {
                $("#group-number").empty();
                $.each(JSON.parse(data), function(index, value) {
                    $("#group-number").append("<option value=" + value + ">" + value + "</option>");
                });
            }
        });
    });
');
?>

<div class="container text-bold">
<div class="row">


    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data',
        ],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-sm-0 control-label'],
        ],
    ]); ?>

<div class="col align-self-center">

<?= $form->field($model, 'imageFile')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'], // Accept only image files
        'pluginOptions' => [
            'showUpload' => false, // Hide the upload button
            'showRemove' => true, // Hide the remove button
            'initialPreview' =>'<img src="'.Yii::$app->request->baseUrl."/".$model->profileImage.'" class="file-preview-image img-circle elevation-2 pull-right" style="width: 150px;">',
            // 'initialPreview' => isset($model->profileImage) ? Html::img($model->profileImage, ['class' => 'file-preview-image img-circle', 'style' => 'width: 150px; height: 150px;', 'alt' => 'Profile Image']) : null,
            'initialPreviewConfig' => [
                [
                    //'caption' => basename($model->profileImage),
                    'width' => '120px', // Adjust the width as needed
                    //'url' => Yii::$app->urlManager->createUrl(['/controller/delete-profile-image']), // Action to delete the image
                    'key' => 0, // Use 0 if there's only one image
                ]
            ],
           'initialPreviewAsData' => true,
            //'overwriteInitial' => true,
            //'browseClass' => 'btn btn-primary btn-block', // Bootstrap button style
            //'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' => 'Choose Image', // Button label
        ]
    ]); ?>
</div>
 <span class="row">
 <div class="col-sm-4 mb-3 mb-sm-0">
    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
 </div>
 <div class="col-sm-3 mb-3 mb-sm-0">
    <?= $form->field($model, 'mname')->textInput(['maxlength' => true]) ?>
 </div>
 <div class="col-sm-5 mb-3 mb-sm-0">
    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
 </div>
    </span>

    <!-- < ?= $form->field($model, 'userID')->textInput(['class' => 'form-control','value' => Yii::$app->user->id]) ?> -->

   <br>

<span class="row">
<div class="col-sm-4 mb-3 mb-sm-0">
<?= $form->field($model, 'emailAddress')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-sm-3 mb-3 mb-sm-0">
<?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => true]) ?>

</div>
<div class="col-sm-5 mb-3 mb-sm-0">
<?= $form->field($model, 'regNo')->textInput(['maxlength' => true]) ?>
</div>
</span>
<br><br>
<span class="row">
<div class="col-sm-4 mb-3 mb-sm-0">
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

<div class="col-sm-5 mb-3 mb-sm-0">
<?= $form->field($model, 'programmeCode')->widget(Select2::class, [
        'data' => $programmeCodes,
        'options' => ['placeholder' => 'Select a programme...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
</div>
</span>
<div class="col-sm-3 mb-3 mb-sm-0">
<?= $form->field($model, 'groupID')->widget(Select2::class, [
    'data' => [], // Data will be populated dynamically via AJAX
    'options' => ['placeholder' => 'Select group number...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
</div>
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
   

    <!-- < ?= $form->field($model, 'profileImage')->textInput(['maxlength' => true]) ?> -->

    <!-- < ?= $form->field($model, 'groupID')->textInput(['class' => 'form-control']) ?> -->
    


    

    <br><br>

    <div class="d-flex justify-content-end">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>

