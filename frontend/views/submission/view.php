<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Submission $model */

$this->title = $model->assignment->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Submissions'), 'url' => null];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$isInstructor = frontend\models\User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor' ;

?>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        < ?= Html::a(Yii::t('app', 'Update'), ['update', 'SubmissionID' => $model->SubmissionID], ['class' => 'btn btn-primary']) ?>
        < ?= Html::a(Yii::t('app', 'Delete'), ['delete', 'SubmissionID' => $model->SubmissionID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
    'model' => $model,
    // 'options' => [
    //     
    // ],
    'attributes' => [
        //'SubmissionID',
        //'AssignmentID',
        [
            'attribute' => 'assignment.courseCode',
            'label' => 'Course Code', // Optionally, you can specify a custom label for the attribute
        ],
        //'groupID',
        //'StudentID',
        [
            'attribute' => 'Student Name',
            'value' => function ($model) {
                return $model->student->fname . '   ' .$model->student->lname;
            },
        ],
        'student.regNo',
        [
            'attribute' => 'SubmissionContent',
            'format' => 'html',
            // 'value' => function ($model) {
            //     return $model->SubmissionContent;
            // },
        ],
        [
            'attribute' => 'submissionDate',
            'label' => 'Date submitted'
        ],
        [
            'attribute' => 'fileURL',
            'label' => 'Attached File',
            'value' => function ($model) {
                //return $model->student->fname . '   ' .$model->student->lname;
                if (!empty($model->fileURL)){
                    return $model->fileURL;
                }else{
                    return 'No file Attached';
                }
            },
        ],
        'SubmissionStatus',
        'score',
    ],
]) ?>
<br><br>
<?php if($isInstructor): ?>
<div class="d-flex justify-content-center">
    <div class="text-center">
    <?php $form = ActiveForm::begin(['action' => ['mark', 'SubmissionID' => $model->SubmissionID], 'method' => 'post']) ?>
            <?= Html::submitButton(Yii::t('app', 'mark Assignment'), ['class' => 'btn btn-lg btn-primary mt-4 mb-1 w-10']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php endif;?>

