<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Student $model */

$this->title = $model->fname. ' '. $model->lname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Students'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'StudentID',
            'fname',
            'mname',
            'lname',
           // 'userID',
            'session',
            'regNo',
            'phoneNumber',
            'emailAddress:email',
            'gender',
            //'profileImage',
            'groupID',
            'programmeCode',
            'year',
            'semester',
        ],
    ]) ?>

<div class="d-flex justify-content-center">
<?= Html::a(Yii::t('app', 'Update'), ['update', 'StudentID' => $model->StudentID], ['class' => 'btn btn-primary']) ?>

</div>
</div>
