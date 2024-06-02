<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Student $model */

$this->title = $model->fname. ' '.$model->lname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-view">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'StudentID',
            'fname',
            'mname',
            'lname',
            //'userID',
            'session',
            'regNo',
            'phoneNumber',
            'emailAddress:email',
            'gender',
            //'profileImage',
            'programmeCode',
            'year',
            'semester',
        ],
    ]) ?>

</div>
<div class="row d-flex">
<div class="col m-5">
<?= Html::a(Yii::t('app', 'Update'), ['update', 'StudentID' => $model->StudentID], ['class' => 'btn btn-outline-primary']) ?>

</div>        
<div class="col m-5">
<?= Html::a(Yii::t('app', 'Delete'), ['delete', 'StudentID' => $model->StudentID], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this Student?'),
                'method' => 'post',
            ],
        ]) ?>
</div>
    
</div>     