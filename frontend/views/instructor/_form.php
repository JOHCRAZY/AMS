<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var frontend\models\Instructor $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="instructor-form">

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
            'initialPreview' => isset($model->profileImage) ? Html::img($model->profileImage, ['class' => 'file-preview-image img-circle', 'style' => 'width: 150px; height: 150px;', 'alt' => 'Profile Image']) : null,
            'initialPreviewConfig' => [
                [
                    'caption' => basename($model->profileImage),
                    'width' => '120px', // Adjust the width as needed
                    //'url' => Yii::$app->urlManager->createUrl(['/controller/delete-profile-image']), // Action to delete the image
                    'key' => 0, // Use 0 if there's only one image
                ]
            ],
           'initialPreviewAsData' => true,
            'overwriteInitial' => true,
            'browseClass' => 'btn btn-primary btn-block', // Bootstrap button style
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' => 'Select Image', // Button label
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
<br><br>
<span class="row">
<div class="col-sm-8 mb-3 mb-sm-0">
<?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-sm-4 mb-3 mb-sm-0">
<?= $form->field($model, 'emailAddress')->textInput(['maxlength' => true]) ?>
</div>
</span>

<br><br>
    <div class="d-flex justify-content-end">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
