<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\User $model */

$this->title = $model->UserID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>
<!-- 
    <p>
        < ?= Html::a(Yii::t('app', 'Update'), ['update', 'UserID' => $model->UserID], ['class' => 'btn btn-primary']) ?>
        < ?= Html::a(Yii::t('app', 'Delete'), ['delete', 'UserID' => $model->UserID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'UserID',
            'username',
            //'password',
            'role',
            'password_hash',
            'password_reset_token',
            'verification_token',
            'email:email',
            //'email_verified:email',
            'auth_key',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
