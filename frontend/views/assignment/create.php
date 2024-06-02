<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */

$this->title = Yii::t('app', 'New Assignment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
