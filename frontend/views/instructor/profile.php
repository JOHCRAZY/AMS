<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Instructor $model */

$this->title = Yii::t('app', yii::$app->user->identity->username);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instructors'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
