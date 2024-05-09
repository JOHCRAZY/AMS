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
<div class="card rounded-5 p-1" >

<center class="mb-lg-2 p-xl-5">
    <img src="<?= Yii::$app->request->baseUrl.'/'.$model->profileImage ?>" class="img-circle rounded-4 elevation-2 pull-right" style="width: 70px;">

</center>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

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
            //'groupID',
            'programmeCode',
            'year',
            'semester',
        ],
    ]) ?>
</div>
