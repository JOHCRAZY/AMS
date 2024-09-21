<?php

use yii\bootstrap5\BootstrapAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Usage with model and Active Record
/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */
/** @var yii\widgets\ActiveForm $form */
/** @var mixed $editedBy */

BootstrapAsset::register($this);
$this->registerJsFile('@web/js/ckeditor.js', ['depends' => [\yii\web\JqueryAsset::class]]);
Yii::$app->session->setFlash('info', 'Remember to save Your Assignment before submitting.');

$this->registerJs(<<<JS
$(document).ready(function(){
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});
JS
);

//$description = Html::decode($model->description);

?>

<div class="container-fluid p-2">

    <?php if ($model->assignment == 'Group Assignment' && $editedBy != null): ?>
        <span class="row m-3 rounded-4">
            <div class="row justify-content-md-center">
                <p class="text-center text-primary p-2">Last Edited by: <?=html::decode($editedBy)?></p>
                <button class="btn btn-outline-primary w-25" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasScrolling">View Group Members</button>
            </div>
        </span>
    <?php endif;?>

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'AssignmentContent')->textarea(['id' => 'editor', 'rows' => 40])?>

    <br>

    <div class="row row-cols-6 justify-content-between">
        <div class="col">
            <?=Html::button('Review Assignment', [
    'id' => 'popoverButton',
    'class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-10',
    'data-bs-toggle' => 'popover',
    'data-bs-container' => 'html',
    'data-bs-placement' => 'left',
    'data-bs-title' => 'Assignment',
    'data-bs-html' => 'true',
    'data-bs-content' => $model->description, //html_entity_decode($description),
])?>
        </div>
    </div>

    <br>

    <?=$form->field($model, 'file')->widget(\kartik\file\FileInput::class, [
    'options' => ['accept' => 'pdf/*', 'class' => 'btn btn-lg btn-primary mt-4 mb-1 w-10'],
    'pluginOptions' => [
        'showUpload' => false,
        'browseLabel' => 'Select',
        'removeLabel' => 'Remove',
        'initialPreview' => $model->fileURL ? Yii::$app->request->baseUrl . "/attachments/" . $model->fileURL : '',
        'initialPreviewAsData' => true,
        'initialCaption' => $model->fileURL ? $model->fileURL : 'No file selected',
        'overwriteInitial' => true,
        'maxFileSize' => 25228,
    ],
]);?>

    <br>

    <div class="row justify-content-between">


        <?php if ($model->fileURL): ?>
            <div class="col">
                <?=Html::a(Yii::t('app', 'Review Attachment'), ['view-file', 'filePath' => $model->fileURL], ['class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-10'])?>
            </div>
        <?php endif;?>

        <div class="col">
            <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-10'])?>
        </div>
        <!-- < ?php if ($model->AssignmentContent): ?>
            <div class="col">
                < ?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-10']) ?>
            </div>
        < ?php endif; ?> -->
    </div>

    <?php ActiveForm::end();?>

</div>
