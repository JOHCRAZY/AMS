<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */

$this->title = Yii::t('app', 'Taking Assignment: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'AssignmentID' => $model->AssignmentID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'DO');
?>
<div class="assignment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_do', [
        'model' => $model,
    ]) ?>

</div>
