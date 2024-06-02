<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Instructor $model */

$this->title = $model->fname .' '. $model->lname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instructors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="instructor-view ">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fname',
            'mname',
            'lname',
            'emailAddress:email',
            'phoneNumber',
            [
                'attribute' => 'courses.courseCode',
                'label' => 'Module Code',
                'value' => function($model){
                if($model->Status == 'Verified'){
                    return frontend\models\Course::find()->where(['courseInstructor' => $model->InstructorID])->one()->courseCode;
                }
                }
            ],
            [
                'attribute' => 'courses.courseName',
                'label'=>'Module Name',
            	'value' => function($model){
                    if($model->Status == 'Verified'){
                        return frontend\models\Course::find()->where(['courseInstructor' => $model->InstructorID])->one()->courseName;
                    }                }
            ],
            'Status',
        ],
    ]) ?>

</div>
<div class="row d-flex">
<div class="col m-5">
<?= Html::a(Yii::t('app', 'Update'), ['update', 'InstructorID' => $model->InstructorID], ['class' => 'btn btn-outline-primary']) ?>

</div>
<div class="col m-5">
<?= Html::a(Yii::t('app', 'Delete'), ['delete', 'InstructorID' => $model->InstructorID], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this instructor?'),
                'method' => 'post',
            ],
        ]) ?>
</div>
</div>
