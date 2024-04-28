<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Assignment $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$isInstructor = frontend\models\User::findByUsername(Yii::$app->user->identity->username)->role == 'instructor' ;

?>

<div class="assignment-view">

    <h1><?= Html::encode($this->title) ?></h1>
<?php if($isInstructor): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'AssignmentID' => $model->AssignmentID], ['class' => 'btn btn-primary']) ?>
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
        <?= Html::a(Yii::t('app', 'Take Assignment'), ['do', 'AssignmentID' => $model->AssignmentID], ['class' => 'btn btn-primary']) ?>
        </p>
<?php endif ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'AssignmentID',
            'courseCode',
            'assignment',
            'title',
            //'content:ntext',
            'description:ntext',
            'fileURL',
            'assignedDate',
            'submissionDate',
            'marks',
            'status',
           
        ],
    ]) ?>

</div>
