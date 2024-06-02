<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\editors\Summernote;
use yii\bootstrap5\BootstrapAsset;

// Usage with model and Active Record
/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */
/** @var yii\widgets\ActiveForm $form */
/** @var mixed $editedBy */

BootstrapAsset::register($this);

$this->registerJs(<<<JS
$(document).ready(function(){
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

});
JS
);

$description = Html::decode($model->description);

?>



<div class="card p-1">

<?php if($model->assignment == 'Group Assignment' && $editedBy != null): ?>
<span class="row m-3 rounded-4">
<div class="row justify-content-md-center">
<p class="text-center text-primary p-2">Last Edited by: <?= html::decode($editedBy) ?></p>
<button class="btn btn-outline-primary w-25" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasScrolling">Group Members</button>
</div>
</span>

<?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AssignmentContent')->widget(Summernote::class, [
    'options' => [
        'placeholder' => Yii::t('app', 'Write here...'),
        //'style' => 'width: 50%; height: 900px;',
    ],
    'pluginOptions' => [
        'height' => 400,
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
            'onChange' => Yii::$app->session->setFlash('info', 'Remember to save Your Assignment before  Submit.'),
        ],
    ],
]); ?>
<br>

<div class="row row-cols-6 justify-content-between">
<div class="col">
<?= Html::button('Assignment ?.', [
    'id' => 'popoverButton',
    'class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-10',
    'data-bs-toggle' => 'popover',
    'data-bs-container' => 'body',
    'data-bs-placement' => 'left',
    'data-bs-title' => 'Assignment',
    'data-bs-html' => 'true',
    'data-bs-content' => html_entity_decode($description),
]) ?>

</div>


</div>
<br>
<?= $form->field($model, 'file')->widget(\kartik\file\FileInput::class, [
    'options' => ['accept' => 'image/*','class' => ['btn btn-lg btn-primary mt-4 mb-1 w-10']], // you can set the accepted file types here
    'pluginOptions' => [
        'showUpload' => false, 
        'browseLabel' => 'Select File',
        'removeLabel' => 'Remove',
        'initialPreview' => $model->fileURL ? Yii::$app->request->baseUrl."/attachments/".$model->fileURL : '',
        'initialPreviewAsData' => true,
        'initialCaption' => $model->fileURL ? $model->fileURL : 'No file selected',
        'overwriteInitial' => true,
        'maxFileSize' => 25228,
    ]
]); ?>
<br>

</div>
<br><br>
<!-- < ?= $form->field($model, 'StudentID')->hiddenInput(['value' => Student::find()->where(['userID' => Yii::$app->user->id])->one()->StudentID])->label(false) ?> -->
<div class="row justify-content-between">
<div class="col">
<?php $form = ActiveForm::begin(['action' => ['do', 'AssignmentID' => $model->AssignmentID, 'StudentID' => frontend\models\Student::find()->where(['userID' => yii::$app->user->id])->one()->StudentID], 'method' => 'post']) ?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-10']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php if($model->fileURL):?>
        <div class="col">
        <?= Html::a(Yii::t('app', 'previous Attachment'), ['view-file' ,'filePath' => $model->fileURL ], ['class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-10'])?>
    </div>
    <?php endif;?>
    <?php if($model->AssignmentContent): ?>
    <div class="col">
    <?php $form = ActiveForm::begin(['action' => ['do','Submit' => true, 'AssignmentID' => $model->AssignmentID, 'StudentID' => frontend\models\Student::find()->where(['userID' => yii::$app->user->id])->one()->StudentID], 'method' => 'post']) ?>
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-10']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <?php endif;?>
</div>