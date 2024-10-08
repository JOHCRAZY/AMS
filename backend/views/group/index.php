<?php

use backend\models\Group;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\Groups $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
<!-- 
    <p>
        < ?= Html::a(Yii::t('app', 'Create Group'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'GroupID',
            'GroupNO',
            'groupName',
            'StudentID',
            'courseCode',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Group $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'GroupID' => $model->GroupID]);
                 },
                 'template' => '{view}{update}',

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
