<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Group $model */

$this->title = Yii::t('app', 'Update Group: {name}', [
    'name' => $model->GroupID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->GroupID, 'url' => ['view', 'GroupID' => $model->GroupID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
