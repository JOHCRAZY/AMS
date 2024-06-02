<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Course $model */

$this->title = $model->courseCode;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Courses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card m-3 p-2 rounded-4">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        < ?= Html::a(Yii::t('app', 'Update'), ['update', 'courseCode' => $model->courseCode], ['class' => 'btn btn-primary']) ?>
        < ?= Html::a(Yii::t('app', 'Delete'), ['delete', 'courseCode' => $model->courseCode], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this Course?'),
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'courseName',
            'courseCode',
            'semester',
            'year',
            [
                'attribute'=> 'Course Instructor',
                'format'=> 'text',
                'value'=> function ($model){
                    $instructor = \backend\models\Instructor::findOne(['InstructorID' => $model->courseInstructor]);
                    if($instructor){
                        return $instructor->fname. ' ' .$instructor->lname;
                    }
                }
            ],
            'programmeCode',
        ],
    ]) ?>

</div>
<div class="row d-flex">
<div class="col m-5">
<?= Html::a(Yii::t('app', 'Update'), ['update', 'courseCode' => $model->courseCode], ['class' => 'btn btn-outline-primary']) ?>

</div>
<div class="col m-5">
<?= Html::a(Yii::t('app', 'Delete'), ['delete', 'courseCode' => $model->courseCode], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this Course?'),
                'method' => 'post',
            ],
        ]) ?>
</div>
</div>