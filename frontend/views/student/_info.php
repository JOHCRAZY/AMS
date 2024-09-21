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
<div class="text-primary P-3" >

<center class="mb-2">
    <img src="<?= Yii::$app->request->baseUrl.'/profiles/'.$model->profileImage ?>" class="rounded-4 mt-1" style="width: 70px;">

</center>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fname',
            'mname',
            'lname',
            'session',
            'regNo',
            'phoneNumber',
            'emailAddress:email',
            'gender',
        [           
            'attribute' => 'Programme',
            'label' => 'Programme',
            'value'=> function ($model){
                return $model->programmeCode0->programmeName;  
            }            
        ],        
            [
                'attribute' => 'programmeCode',
                'label' => 'Programme Code'
        ],
            'year',
            'semester',
        ], 
     ]) ?>
</div>
