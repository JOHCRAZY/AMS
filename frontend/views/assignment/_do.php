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

<div class="assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'courseCode')->textInput(['maxlength' => true]) ?>

    <!-- < ?= $form->field($model, 'content')->textarea(['rows' => 6]) ?> -->

    <?= $form->field($model, 'content')->widget(Summernote::class, [
    'options' => [
        'placeholder' => Yii::t('app', 'Write something...'),
        'style' => 'width: 100%; height: 900px;',
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
            'onChange' => new \yii\web\JsExpression('function(contents, $editable) {
                console.log("Editor content changed:", contents);
            }'),
        ],
    ],
]); ?>

    <?= $form->field($model, 'fileURL')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



