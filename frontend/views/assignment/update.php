<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */

$this->title = Yii::t('app', 'Update | {name}', [
    'name' => $model->title,
]);
$isInstructor = frontend\models\User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor' ;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => $isInstructor ? ['index'] : ''];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'AssignmentID' => $model->AssignmentID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container">

    <h1 class="text-center"><?= Html::encode($model->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
