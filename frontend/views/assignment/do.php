<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */

$this->title = Yii::t('app', 'Edit | {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'AssignmentID' => $model->AssignmentID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'DO');
?>

<h1 class="text-center"><?= Html::encode($model->title) ?></h1>

<div class="card bg-body-secondary text-bg-info text-capitalize text-center">


    <?= $this->render('_do', [
        'model' => $model,
    ]) ?>

</div>
<div class="card mt-5 text-center">
    <?= date('Y-m-d H:m')?>
</div>
