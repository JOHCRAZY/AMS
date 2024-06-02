<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Assignment $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="assignment-view">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'AssignmentID',
            'courseCode',
            'assignment',
            'title',
            //'AssignmentContent:ntext',
            'description:ntext',
            //'fileURL',
            'assignedDate:datetime',
            'submissionDate:datetime',
            'marks',
            'status',
        ],
    ]) ?>

</div>
<div class="row d-flex">
<div class="col">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'AssignmentID' => $model->AssignmentID], ['class' => 'btn btn-outline-primary']) ?>
        
</div>
<div class="col">
<?= Html::a(Yii::t('app', 'Delete'), ['delete', 'AssignmentID' => $model->AssignmentID], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this Assignment?'),
                'method' => 'post',
            ],
        ]) ?>
</div>
</div>