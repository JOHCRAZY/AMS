

<?php
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Submission $model */
/** @var yii\widgets\ActiveForm $form */
$this->registerJsFile('@web/js/ckeditor.js', ['depends' => [\yii\web\JqueryAsset::class]]);

?>

<?php $form = ActiveForm::begin(['action' => ['mark', 'Marked' => true, 'SubmissionID' => $model->SubmissionID]]); ?>
<?= $form->field($model, 'SubmissionContent')->textarea(['id' => 'editor', 'rows' => 40]) ?>


    <?php if ($model->fileURL && pathinfo($model->fileURL, PATHINFO_EXTENSION) == 'pdf') : ?>
  <div class="container">
      <iframe src="<?= Yii::getAlias('@web') ?>/assignment/load-file?filePath=< ?= urlencode($model->fileURL) ?>" width="100%" height="600"></iframe>
  </div>
  <?php endif; ?>

      <div class="col">
          <?= $form->field($model, 'PreScore')->textInput(['type' => 'number', 'placeholder' => 'Enter Student Score']) ?>
      </div>

      <div class="row justify-content-center">
        <?= Html::submitButton(Yii::t('app', 'Save Marked '), ['class' => 'btn btn-lg btn-outline-primary mt-4 mb-1 w-50']) ?>
    </div>
    <?php ActiveForm::end(); ?>
