<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Programme $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="programme-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'programmeCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'programmeName')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
