<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Group $model */

$this->title = $model->GroupID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'GroupID' => $model->GroupID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'GroupID' => $model->GroupID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <!-- < ?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'GroupID',
            'GroupNO',
            'groupName',
            'StudentID',
            'courseCode',
        ],
    ]) ?> -->

<?php
echo DetailView::widget([
    'model' => $model, // Assuming $model contains the data of a specific group
    'attributes' => [
        'GroupNO',
        'groupName',
        [
            'label' => 'Members',
            'value' => function ($model) {
                $members = [];
                foreach ($model->student as $student) {
                    $members[] = $student;//->fname . ' ' . $student->lname;
                }
                return implode('\n', $members);
            },
        ],
    ],
]); ?>

</div>
