<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\editors\Summernote;

// Usage with model and Active Record
/** @var yii\web\View $this */
/** @var frontend\models\Submission $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="container fluid">
  <?php $form = ActiveForm::begin(['action' => ['mark', 'Marked' => true, 'SubmissionID' => $model->SubmissionID]]); ?>

  <div class="container w-100">
      <?= $form->field($model, 'SubmissionContent')->widget(Summernote::class, [
          'options' => [
              'placeholder' => Yii::t('app', 'Assignment content'),
              'style' => 'width: 100%; height: 400px;',
              'readonly' => true, // Assignment content should be read-only for marking
          ],
          'pluginOptions' => [
              'height' => 350,
              'toolbar' => [], // Disable toolbar since content is read-only
          ],
      ]); ?>
  </div>

  <br>

  <?php if ($model->fileURL && pathinfo($model->fileURL, PATHINFO_EXTENSION) == 'pdf') : ?>
  <div class="container">
      <iframe src="<?= Yii::getAlias('@web') ?>/assignment/load-file?filePath=<?= urlencode($model->fileURL) ?>" width="100%" height="600"></iframe>
  </div>
  <?php endif; ?>

  <div class="row">
      <div class="col">
          <?= $form->field($model, 'PreScore')->textInput(['type' => 'number', 'placeholder' => 'Enter Score']) ?>
      </div>
  </div>

  <br><br>

  <div class="row justify-content-between">
      <div class="col">
          <?= Html::submitButton(Yii::t('app', 'Marked '), ['class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-50']) ?>
          <?php ActiveForm::end(); ?>
      </div>
  </div>
</div>
