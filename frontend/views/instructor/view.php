<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Instructor $model */

$this->title = $model->fname. ' '. $model->lname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instructors'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <center class="mb-lg-2 p-xl-5">
    <img src="<?= Yii::$app->request->baseUrl.'/'.$model->profileImage ?>" class="rounded img-circle elevation-2 pull-right" style="width: 70px;">

</center>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'InstructorID',
            'fname',
            'mname',
            'lname',
           // 'UserID',
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
<div class="d-flex justify-content-center">
<?= Html::a(Yii::t('app', 'Update'), ['update', 'InstructorID' => $model->InstructorID], ['class' => 'btn btn-primary']) ?>

</div>
</div>
