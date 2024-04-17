<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Student $model */

$this->title = $model->StudentID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'StudentID' => $model->StudentID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'StudentID' => $model->StudentID], [
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
            'StudentID',
            'fname',
            'mname',
            'lname',
            'userID',
            'section',
            'regNo',
            'phoneNumber',
            'emailAddress:email',
            'gender',
            'profileImage',
            'groupID',
            'courseCode',
            'programmeCode',
            'year',
            'semester',
        ],
    ]) ?>

</div>
