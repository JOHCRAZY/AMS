<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Submission $model */

$this->title = Yii::t('app', 'Create Submission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Submissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="submission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
