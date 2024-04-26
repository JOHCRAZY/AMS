<?php

use yii\helpers\Html;
use kartik\editors\Summernote;
/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */
/** @var yii\widgets\ActiveForm $form */
/** @var bool $courseCodes */

// Usage with model and Active Record

echo $form->field($model, 'content')->widget(Summernote::class, [
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
]);
