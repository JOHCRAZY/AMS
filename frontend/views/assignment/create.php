<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */

$this->title = Yii::t('app', 'Create New Assignment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/ckeditor.js', ['depends' => [\yii\web\JqueryAsset::class]]);

?>
<div class="container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
