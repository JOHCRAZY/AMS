<?php

use backend\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\Users $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'All Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
<!-- 
    <p>
        < ?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'UserID',
            'username',
            //'password',
            'role',
            //'password_hash',
            //'password_reset_token',
            //'verification_token',
            'email:email',
            //'email_verified:email',
            //'auth_key',
            //'status',
            'created_at:datetime',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'UserID' => $model->UserID]);
                 },
                 'template' => '{view}{update}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
