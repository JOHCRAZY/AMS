<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\editors\Summernote;
/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container p-3 h-100">

<?php $form = ActiveForm::begin(); ?>
<span class="row">

<div class="col">
<?= $form->field($model, 'assignment')->widget(\kartik\select2\Select2::class, [
    'data' => ['Individual Assignment' => 'Individual Assignment', 'Group Assignment' => 'Group Assignment'],
    'options' => ['placeholder' => 'Select assignment type'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
</div>

<div class="col">
<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

</div>
    </span>
    <br><br>

<Span class="row">
    <div class="col">
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
<br>



<!-- < ?= $form->field($model, 'description')->textarea(['rows' => 10]) ?> -->
<span class="row ">
    <div class="col">
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
            'onChange' => Yii::$app->session->setFlash('info', 'Remember to save Your Assignment before  Submit.'),
        ],
    ],
]); ?>
    </div>
</span>
<br>


<div class="row justify-content-between">
    <div class="col">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-10']) ?>
    <?php ActiveForm::end(); ?>
    </div>
    <div class="col">

    <?= Html::beginForm(['submit', 'AssignmentID' => $model->AssignmentID], 'post') ?>
    <?= Html::submitButton(Yii::t('app', 'Send Assignment'), ['class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-10']) ?>
<?= Html::endForm() ?>
    </div>
</div>
<br><br>
</div>

