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
<div class="instructor-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            //'profileImage',
        ],
    ]) ?>
<div class="d-flex justify-content-center">
<?= Html::a(Yii::t('app', 'Update'), ['update', 'InstructorID' => $model->InstructorID], ['class' => 'btn btn-primary']) ?>

</div>
</div>
