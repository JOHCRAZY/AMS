<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Instructor $model */

$this->title = $model->InstructorID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instructors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="instructor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'InstructorID' => $model->InstructorID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'InstructorID' => $model->InstructorID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'InstructorID',
            'fname',
            'mname',
            'lname',
            'UserID',
            'emailAddress:email',
            'phoneNumber',
            'profileImage',
        ],
    ]) ?>

</div>
