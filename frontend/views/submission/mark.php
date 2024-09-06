<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */

$this->title = Yii::t('app', 'MARKING  | {name}', [
    'name' => $model->assignment,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => null];
$this->params['breadcrumbs'][] = ['label' => $model->assignment, 'url' => ['view', 'AssignmentID' => $model->AssignmentID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Mark Assignment');
?>

<h1 class="text-center"><?= Html::encode($model->assignment) ?></h1>

<div class="container-fluid">


    <?= $this->render('_mark', [
        'model' => $model,
    ]) ?>

</div>
<div class="m-5 text-center">
    <?= Yii::$app->formatter->asDatetime(time())?>
</div>
