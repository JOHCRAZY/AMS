<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Programme $model */

$this->title = Yii::t('app', 'Update Programme: {name}', [
    'name' => $model->programmeCode,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Programmes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->programmeCode, 'url' => ['view', 'programmeCode' => $model->programmeCode]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="programme-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
