

<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>


<div class="container mt-8" style="margin-left: auto" >
    <div class="row justify-content-center">
        <div class="col-md-5 mt-5">
             
        <div class="card rounded-5 text-white bg-dark border-success mb-3">
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'card-body'],
               
            ]); ?>

                <div class="text-center">
                    <h1 class="title">Login</h1>
                    <p class="lead">Task Management System</p>
                </div>

                <?= $form->field($model, 'username')->textInput(['id' => 'username','class'=>'form-control', 'placeholder' => 'example.johcrazy@eastc.ac.tz'])->label('Username') ?>

                <?= $form->field($model, 'password')->passwordInput(['id' => 'password',  'placeholder' => '********'])->label('Password') ?>

                <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>
                <div class="text-center">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-success btn-color px-5 mb-5 w-100']) ?>
                </div>
                <?php ActiveForm::end(); ?>
                <div class="text-center" style="color:#999;">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                    <br>
                    Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                </div>
                <div class="form-text text-center mb-5 text-dark">

                    <?php 
                   echo Html::beginForm(['/site/signup'])
                    . Html::submitButton(
                        'Not Registered? <code> Register here </code>',
                        ['class' => 'btn btn-link fw-bold']
                    )
                    . Html::endForm();
                    ?>
                </div>
</div>


        </div>
    </div>
</div>





            

















<!-- < ?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1>< ?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            < ?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                < ?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                < ?= $form->field($model, 'password')->passwordInput() ?>

                < ?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="my-1 mx-0" style="color:#999;">
                    If you forgot your password you can < ?= Html::a('reset it', ['site/request-password-reset']) ?>.
                    <br>
                    Need new verification email? < ?= Html::a('Resend', ['site/resend-verification-email']) ?>
                </div>

                <div class="form-group">
                    < ?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            < ?php ActiveForm::end(); ?>
        </div>
    </div>
</div> -->
