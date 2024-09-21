<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\User $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use common\widgets\Alert;

$this->title = 'AMS | Signup';
?>

            <div class="container " style="background-color: rgba(82, 86, 89,0);">

          <div class="row justify-content-center mt-4">
            <div class="col-sm-4">
        
            <div class="p-4 elevation-5 rounded-4" style="min-width: 350px;color: #fff; background-color: rgb(38, 38, 42);">
            <?=Alert::widget([
                    'options' => ['class' => 'bg-primary']
                ])?>
            <div class="text-center text-primary">
                    <h1 class="title">SignUp to AMS</h1>
                    <p class="lead">Assignment Management System</p>
                </div>
                <?php $form = ActiveForm::begin([
                                'options' => ['class' => 'card-body'],

            ]); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => '********']) ?>
                <?= $form->field($model, 'VerifyPassword')->passwordInput(['placeholder' => '********']) ?>


                <?= $form->field($model, 'role')->dropDownList(['student'=> 'Student','instructor'=> 'Instructor'],['prompt' => '---Select---']) ?>

                <div class="text-center">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-outline-primary mt-2 w-100', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            <div class="text-center">
            Already have account  <?= Html::a('Login Here', ['site/login'],['class' => 'btn btn-link fw-bold','style' => 'text-decoration: none;']) ?>

                </div>
            </div>
            </div>
          </div>
            </div>


