<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var backend\models\Instructor $model */
/** @var yii\widgets\ActiveForm $form */
/** @var backend\models\Course $Courses[] */
?>

<div class="card w-100 p-3 m-3 rounded-5 justify-content-between">

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
<br><br>
<span class="row">
 <div class="col-sm-6 mb-3 mb-sm-0">
    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
 </div>
 <div class="col-sm-6 mb-3 mb-sm-0">
    <?= $form->field($model, 'mname')->textInput(['maxlength' => true]) ?>
 </div>
 <div class="col-sm-6 mt-4 mb-3 mb-sm-0">
    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
 </div>
    </span>
<br><br>
<span class="row">
<div class="col-sm-6 mb-3 mb-sm-0">
<?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => true]) ?>
</div>

<div class="col-sm-6 mb-3 mb-sm-0">
<?= $form->field($model, 'emailAddress')->textInput(['maxlength' => true]) ?>
</div>
</span>
<br><br>
<span class="row">
<div class="col-sm-6 mb-3 mb-sm-0">
<?= $form->field($model, 'Course')->widget(Select2::class, [
        'data' => \yii\helpers\ArrayHelper::map($Courses, 'courseCode', 'courseName'),
        'options' => ['placeholder' => $model->Status == 'Verified' ? frontend\models\Course::find()->where(['courseInstructor' => $model->InstructorID])->one()->courseName : 'Select a Course...'],
        'pluginOptions' => [
            'allowClear' => false,
        ],
    ]); ?>
    <?= $form->field($model, 'CourseInstructorID')->textInput(['value' => $model->InstructorID,'hidden' => true]) ?>

</div>
    <div class="col-sm-6">
    <?= $form->field($model, 'Status')->widget(Select2::class, [
        'data' => ['Pending' => 'Pending', 'Verified' => 'Verified'],
        'options' => ['placeholder' => 'Change Status ...'],
        'pluginOptions' => [
            'allowClear' => false,
        ],
    ]); ?>
    </div>    

</span>

<br><br>
<div class="row m-5">
<?= Html::submitButton(Yii::t('app', 'Update | '.$model->fname. ' '.$model->lname), ['class' => 'btn btn-outline-primary w-25']) ?>
</div>
    <?php ActiveForm::end(); ?>
</div>
