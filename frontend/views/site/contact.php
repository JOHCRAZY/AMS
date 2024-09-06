<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Name') ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'email')->textInput()->label('Email') ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'subject')->textInput()->label('Subject') ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'body')->textarea(['rows' => 6])->label('Message') ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-9">{input}</div></div>',
                    ])->label('Verification Code') ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-outline-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
