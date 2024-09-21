<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */
/** @var mixed $editedBy */

$this->title = Yii::t('app', 'Edit | {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'AssignmentID' => $model->AssignmentID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Edit');
?>

<h1 class="text-center"><?= Html::encode($model->title) ?></h1>

<div class="card text-center">


    <?= $this->render('_do', [
        'model' => $model,
        'editedBy' => $editedBy,
    ]) ?>

</div>
<div class="card mt-5 text-center">
    <?= date('Y-m-d H:m',time())?>
</div>
