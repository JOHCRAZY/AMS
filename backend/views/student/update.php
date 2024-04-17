<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Student $model */

$this->title = Yii::t('app', 'Update Student: {name}', [
    'name' => $model->StudentID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->StudentID, 'url' => ['view', 'StudentID' => $model->StudentID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
