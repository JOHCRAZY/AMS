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
            'assignedDate:datetime',
            'submissionDate:datetime',
            'marks',
            'status',
           
        ],
    ]) ?>
    

</div>
<div class="text-center">
    <?php if($isInstructor): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Update Assignment'), ['update', 'AssignmentID' => $model->AssignmentID], ['class' => 'btn btn-outline-primary']) ?>
    </p>
    <?php else: ?>
        <p>
        <?= Html::a(Yii::t('app', 'Take Assignment'), ['do', 'AssignmentID' => $model->AssignmentID,'StudentID' => frontend\models\Student::find()->where(['userID' => Yii::$app->user->id])->one()->StudentID], ['class' => 'btn btn-outline-primary']) ?>
        </p>
<?php endif ?>
    </div>