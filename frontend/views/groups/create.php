<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

?>


    <div class="card rounded-5 p-5 m-5">
        <?php $form = ActiveForm::begin(); ?>
        
        <?php foreach ($model->groups as $index => $group): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Group <?= $index + 1 ?></h3>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, "groups[$index][GroupNO]")->textInput() ?>
                    <?= $form->field($model, "groups[$index][groupName]")->textInput() ?>
                    <?= $form->field($model, "groups[$index][StudentIDs][]")->widget(Select2::class, [
    'data' => \yii\helpers\ArrayHelper::map($students, 'StudentID', function ($student) {
        return $student['fname'] .' '. $student['lname'] . ' - ' . $student['regNo']; // Concatenate columns
    }),
    'options' => ['placeholder' => 'Select students...', 'multiple' => true],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="form-group">
            <?= Html::submitButton('Create Group', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
