<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */

$this->title = $model->title;
$isInstructor = frontend\models\User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor' ;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => $isInstructor ? ['index'] : null];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>

<div class="container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
<?php if($isInstructor): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Update Assignment'), ['update', 'AssignmentID' => $model->AssignmentID], ['class' => 'btn btn-primary']) ?>
        <!-- < ?= Html::a(Yii::t('app', 'Delete'), ['delete', 'AssignmentID' => $model->AssignmentID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?> -->
    </p>
    <?php else: ?>
        <p>
        <?= Html::a(Yii::t('app', 'Take Assignment'), ['do', 'AssignmentID' => $model->AssignmentID,'StudentID' => frontend\models\Student::find()->where(['userID' => Yii::$app->user->id])->one()->StudentID], ['class' => 'btn btn-primary']) ?>
        </p>
<?php endif ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'Course Name',
                'value' => function ($model) {
                    return frontend\models\Course::find()->where(['courseCode' => $model->courseCode])->one()->courseName; // Assuming group_name is the attribute you want to display
                },
            ],
            //'AssignmentID',
            'courseCode',
            'assignment',
            'title',
            //'content:ntext',
            'description:html',
            //'fileURL',
            'assignedDate',
            'submissionDate',
            'marks',
            'status',
           
        ],
    ]) ?>

</div>
