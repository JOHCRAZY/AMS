<?php

use backend\models\Programme;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\Programmes $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Programmes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programme-index">

    <!-- <h1>< ?= Html::encode($this->title) ?></h1>

    <p>
        < ?= Html::a(Yii::t('app', 'Create Programme'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'programmeCode',
            'programmeName',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Programme $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'programmeCode' => $model->programmeCode]);
                 },
                 'template' => '{view}{update}',

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
