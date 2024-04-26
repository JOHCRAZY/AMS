<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\User $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
?>
<div class="container mt-8" style="margin-left: auto">

    <div class="row justify-content-center">
        <div class="col-sm-4 mt-5">
            <div class="card rounded-5 text-white bg-dark border-success mb-3">
            <?php $form = ActiveForm::begin([
                                'options' => ['class' => 'card-body'],

            ]); ?>

            <div class="text-center">
                    <h1 class="title">SignUp</h1>
                    <p class="lead">Assignment Management System</p>
                </div>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => '********']) ?>

                <?= $form->field($model, 'role')->dropDownList(['student'=> 'Student','instructor'=> 'Instructor'],['prompt' => '---Select---']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-success btn-color px-5 mb-5 w-100', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            <div class="text-center mb-5" style="color:#999;">
            Already have account  <?= Html::a('login here', ['site/login']) ?>.

                </div>
            </div>
        </div>
    </div>
</div>


