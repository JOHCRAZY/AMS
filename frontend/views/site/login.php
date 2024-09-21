<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'AMS | Login';
?>

<div class="container-fluid bg-transparent">
    <div class="row justify-content-center mt-5">
        <div class="col-sm-4">
            <div class="p-4 elevation-5 rounded-4 login-box">
                <?php $form = ActiveForm::begin([
                    'options' => ['class' => 'card-body'],
                ]); ?>

                <div class="text-center text-primary mb-4">
                    <h1 class="title">Login to AMS</h1>
                    <p class="lead">Assignment Management System</p>
                </div>

                <?= $form->field($model, 'username')->textInput(['class' => 'form-control', 'placeholder' => 'example.johcrazy@eastc.ac.tz'])->label(' Username') ?>

                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => '************'])->label(' Password') ?>

                
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ]) ?>

                <div class="text-center">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-outline-primary mt-2 w-100']) ?>
                </div>

                <?php ActiveForm::end(); ?>

                <div class="text-center mt-4">
                    <p>Forgot your password? <?= Html::a('Reset Password', ['site/request-password-reset'], ['class' => 'fw-bold', 'style' => 'text-decoration: none;']) ?></p>
                    <p>New verification email? <?= Html::a('Resend', ['site/resend-verification-email'], ['class' => 'fw-bold', 'style' => 'text-decoration: none;']) ?></p>
                    <p>New user? 
                        <?= Html::beginForm(['/site/signup']) .
                            Html::submitButton('Signup', ['class' => 'btn btn-link fw-bold', 'style' => 'text-decoration: none;']) .
                            Html::endForm(); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .login-box {
        min-width: 350px;
        background-color: rgb(38, 38, 42);
        color: #fff;
    }
</style>
