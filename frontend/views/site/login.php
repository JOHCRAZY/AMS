

<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'AMS | Login';
?>


             
        <div class="text border-primary p-4" style="min-width: 400px;">
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'card-body'],
               
            ]); ?>

                <div class="text-center text-primary">
                    <h1 class="title">Login to AMS</h1>
                    <p class="lead">Assignment Management System</p>
                </div>
                <?= $form->field($model, 'username')->textInput(['id' => 'username','class'=>'form-control', 'placeholder' => 'example.johcrazy@eastc.ac.tz'])->label(' Username') ?>

                <?= $form->field($model, 'password')->passwordInput(['id' => 'password',  'placeholder' => '************'])->label(' Password') ?>

                <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>
                <div class="text-center">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-lg btn-outline-primary m-2  w-100']) ?>
                </div>
                <?php ActiveForm::end(); ?>
                <div class="text-center">
                    forgot your password?  <?= Html::a('reset password', ['site/request-password-reset'],['class' => 'btn btn-link fw-bold','style' => 'text-decoration: none;']) ?>
                    <br>
                    New verification email? <?= Html::a('Resend', ['site/resend-verification-email'],['class' => 'btn btn-link fw-bold','style' => 'text-decoration: none;']) ?>
                </div>
                <div class="form-text text-center"> 
                    <?=
                   Html::beginForm(['/site/signup'])
                    . Html::submitButton(
                        'Signup',
                        ['class' => 'btn btn-link fw-bold','style' => 'text-decoration: none;']
                    )
                    .Html::endForm();
                    ?>
                </div>
</div>


