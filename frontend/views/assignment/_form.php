<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\editors\Summernote;
/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container">

<?php $form = ActiveForm::begin(); ?>

<!-- < ?= $form->field($model, 'courseCode')->widget(\kartik\select2\Select2::class, [
    'data' => frontend\models\Course::find()->select(['courseCode','courseName'])->indexBy('courseCode')->column(),
    'options' => ['placeholder' => 'Select course code'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?> -->

<?= $form->field($model, 'assignment')->widget(\kartik\select2\Select2::class, [
    'data' => ['Individual Assignment' => 'Individual Assignment', 'Group Assignment' => 'Group Assignment'],
    'options' => ['placeholder' => 'Select assignment type'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<!-- < ?= $form->field($model, 'description')->textarea(['rows' => 10]) ?> -->
<?= $form->field($model, 'description')->widget(Summernote::class, [
    'options' => [
        'placeholder' => Yii::t('app', 'Assignment here...'),
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

<!-- < ?= $form->field($model, 'fileURL')->textInput(['maxlength' => true]) ?> -->
<!-- < ?= $form->field($model, 'fileURL')->widget(\kartik\file\FileInput::class, [
    'options' => ['accept' => 'image/*'], // you can set the accepted file types here
    'pluginOptions' => [
        'showUpload' => false, // to hide the upload button
        'browseLabel' => 'Select File',
        'removeLabel' => 'Remove',
        //'initialPreview' => $model->fileURL ? Yii::getAlias('@web') . '/path/to/your/file/' . $model->file : '',
        'initialPreviewAsData' => true,
       // 'initialCaption' => $model->file ? $model->file : '',
        'overwriteInitial' => true,
        'maxFileSize' => 1000 // set max file size in KB
    ]
]); ?> -->

<Span class="row">
    <div class="col">
    <!-- < ?= $form->field($model, 'marks')->textInput() ?> -->
<?= $form->field($model, 'marks')->textInput(['type' => 'number', 'placeholder' => 'Enter Score']) ?>

    </div>
    <div class="col">
    <?= $form->field($model, 'submissionDate')->widget(\kartik\datetime\DateTimePicker::class, [
    'options' => ['placeholder' => 'Enter submission date ...'],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd hh:ii:ss'
    ]
]); ?>
    </div>
</Span>



<!-- < ?= $form->field($model, 'status')->dropDownList(['Pending' => 'Pending', 'Submitted' => 'Submitted'], ['prompt' => 'Select status']); ?> -->
<br><br>
<div class="row justify-content-between">
    <div class="col">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-lg btn-primary mt-4 mb-1 w-10']) ?>
    <?php ActiveForm::end(); ?>
    </div>
    <div class="col">
    <!-- < ?php $form = ActiveForm::begin(['action' => ['submit', 'AssignmentID' => $model->AssignmentID], 'method' => 'post']) ?>
            < ?= Html::submitButton(Yii::t('app', 'Send Assignment'), ['class' => 'btn btn-lg btn-primary mt-4 mb-1 w-10']) ?>
        < ?php ActiveForm::end(); ?> -->
    <?= Html::beginForm(['submit', 'AssignmentID' => $model->AssignmentID], 'post') ?>
    <?= Html::submitButton(Yii::t('app', 'Send Assignment'), ['class' => 'btn btn-lg btn-primary mt-4 mb-1 w-10']) ?>
<?= Html::endForm() ?>

    <!-- < ?= Html::a(Yii::t('app', 'Send Assignment'), ['submit', 'AssignmentID' => $model->AssignmentID], ['class' => 'btn btn-lg btn-primary mt-4 mb-1 w-10']) ?> -->
    </div>
</div>

</div>

