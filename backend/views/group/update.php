<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Group $model */

$this->title = Yii::t('app', 'Update Group: {name}', [
    'name' => $model->groupID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->groupID, 'url' => ['view', 'groupID' => $model->groupID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
