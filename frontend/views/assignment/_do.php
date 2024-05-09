<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\editors\Summernote;

/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */
/** @var yii\widgets\ActiveForm $form */
/** @var bool $courseCodes */

// Usage with model and Active Record
/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AssignmentContent')->widget(Summernote::class, [
    'options' => [
        'placeholder' => Yii::t('app', 'Write ...'),
        'style' => 'width: 50%; height: 900px;',
    ],
    'pluginOptions' => [
        'height' => 250,
        'dialogsInBody' => true,
        'dialogsFade' => true,
        'toolbar' => [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']],
        ],
        'callbacks' => [
            'onChange' => Yii::$app->session->setFlash('danger', 'Remember to save Your Assignment before  Submit.'),
        ],
    ],
]); ?>
<br>
<?= $form->field($model, 'file')->widget(\kartik\file\FileInput::class, [
    'options' => ['accept' => 'image/*'], // you can set the accepted file types here
    'pluginOptions' => [
        'showUpload' => false, 
        'browseLabel' => 'Select File',
        'removeLabel' => 'Remove',
        'initialPreview' => $model->fileURL ? Yii::$app->request->baseUrl."/attachments/".$model->fileURL : '',
        'initialPreviewAsData' => true,
        'initialCaption' => $model->fileURL ? $model->fileURL : 'No file selected',
        'overwriteInitial' => true,
        'maxFileSize' => 55228 
    ]
]); ?>
<br>

</div>
<br><br>
<!-- < ?= $form->field($model, 'StudentID')->hiddenInput(['value' => Student::find()->where(['userID' => Yii::$app->user->id])->one()->StudentID])->label(false) ?> -->
<div class="row justify-content-between">
<div class="col">
<?php $form = ActiveForm::begin(['action' => ['do', 'AssignmentID' => $model->AssignmentID, 'StudentID' => frontend\models\Student::find()->where(['userID' => yii::$app->user->id])->one()->StudentID], 'method' => 'post']) ?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-lg btn-primary mt-4 mb-1 w-10']) ?>
        <?php ActiveForm::end(); ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php if($model->fileURL):?>
        <div class="col">
        <?= Html::a(Yii::t('app', 'previous Attachment'), ['view-file' ,'filePath' => $model->fileURL ], ['class' => 'btn btn-lg btn-primary mt-4 mb-1 w-10'])?>
    </div>
    <?php endif;?>
    <?php if($model->AssignmentContent): ?>
    <div class="col">
    <?php $form = ActiveForm::begin(['action' => ['do','Submit' => true, 'AssignmentID' => $model->AssignmentID, 'StudentID' => frontend\models\Student::find()->where(['userID' => yii::$app->user->id])->one()->StudentID], 'method' => 'post']) ?>
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-lg btn-primary mt-4 mb-1 w-10']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <?php endif;?>
</div>