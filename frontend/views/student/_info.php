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
<div class="bg-dark text-bg-primary" >

<center class="mb-lg-2 p-xl-5">
    <img src="<?= Yii::$app->request->baseUrl.'/profiles/'.$model->profileImage ?>" class="rounded-4 mt-1" style="width: 70px;">

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
    //     'template' => "<div class='m-1 row gap-1'>
    //     <div class='col ml-0 p-1 bg-dark text-secondary'> {label} </div>
    //     <br/>
    //     <div class='col ml-0 p-1 bg-dark text-secondary'> {value} </div>
    // </div>",   
     ]) ?>
</div>
