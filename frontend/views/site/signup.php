<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\User $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'AMS | Signup';
?>

            <div class="text border-primary p-4">
            <?php $form = ActiveForm::begin([
                                'options' => ['class' => 'card-body'],

            ]); ?>

            <div class="text-center text-primary">
                    <h1 class="title">SignUp to AMS</h1>
                    <p class="lead">Assignment Management System</p>
                </div>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => '********']) ?>

                <?= $form->field($model, 'role')->dropDownList(['student'=> 'Student','instructor'=> 'Instructor'],['prompt' => '---Select---']) ?>

                <div class="text-center">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-lg btn-outline-primary m-2 w-100', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            <div class="text-center">
            Already have account  <?= Html::a('Login Here', ['site/login'],['class' => 'btn btn-link fw-bold','style' => 'text-decoration: none;']) ?>

                </div>
            </div>


