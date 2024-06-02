<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var frontend\models\Group $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Create Groups';
?>
    
<div class="container rounded-4 p-4 m-4">

<span class="row">

<div class="col">
<button class="btn btn-outline-primary m-2 w-75" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft1" aria-controls="offcanvasScrolling">All Students</button>

</div>
<div class="col">
<button class="btn btn-outline-primary m-2 w-75" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft2" aria-controls="offcanvasScrolling">Available Groups</button>

</div>
    </span>
    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-10\">{input}</div>\n<div class=\"col-lg-10 text-danger\">{error}</div>",
            'labelOptions' => ['class' => 'col-sm-0 m-1 p-1 control-label'],
        ],
    ]); ?>

    <span class="row">
        <div class="col-sm-6">
        <?= $form->field($model, 'groupNO')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-6">
        <?= $form->field($model, 'groupName')->textInput(['maxlength' => true]) ?>

        </div>
    </span>


<div class="row justify-content-center">
    <div class="col-10">

    <?= $form->field($model, 'StudentIDs')->widget(Select2::class, [
    'data' => \yii\helpers\ArrayHelper::map($students, 'StudentID', function ($student) {
        return $student['fname'] .' '. $student['lname'] . ' - ' . $student['regNo'];
    }),
    'options' => ['placeholder' => 'Select students...', 'multiple' => true],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
    </div>
    
</div>


    <div class="row m-4 justify-content-md-center">
    <div class="col-6 m-3">
    <?= Html::submitButton(Yii::t('app', 'Create group'), ['class' => 'btn btn-outline-success']) ?>

    </div>

</div>

    <?php ActiveForm::end(); ?>

</div>
