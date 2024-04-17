<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Assignment $model */

$this->title = Yii::t('app', 'Create Assignment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
