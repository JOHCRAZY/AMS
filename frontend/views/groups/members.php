<?php

use frontend\models\Group;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\groups $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Group Members');
$this->params['breadcrumbs'][] = $this->title;
$allStudents = frontend\models\Student::find()->all();
?>
<div class="container-fluid">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        < ?= Html::a(Yii::t('app', 'Create Group'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        // 'columns' => [
        //     ['class' => 'yii\grid\SerialColumn'],
        //     [
        //         'attribute' => 'student.regNo',
        //         'label' => Yii::t('app', 'Reg No'),
        //         'value' => function ($model) {
        //             if (!empty($model->students)) {
        //                 return $model->students[0]->regNo; // Access the regNo of the first student
        //             }
        //             return null;
        //         },                
        //     ],
        //     [
        //         'label' => Yii::t('app', 'Students'), // Custom label for student information
        //         'value' => function ($model) {
        //             $studentInfo = [];
        //             foreach ($model->students as $student) {
        //                 $studentInfo[] = $student->regNo; // Displaying student registration numbers
        //                 $studentInfo[] = $student->regNo . ' - ' . $student->fname . ' ' . $student->lname; // Concatenating multiple student columns

        //             }
        //             return implode(', ', $studentInfo);
        //         },
        //     ],
        //     'groupNo',
        //     'courseCode',
        //     'groupName',
        //     [
        //         'class' => ActionColumn::class,
        //         'urlCreator' => function ($action, Group $model, $key, $index, $column) {
        //             return Url::toRoute([$action, 'groupID' => $model->groupID]);
        //          },
        //          'template' => ''
        //     ],
        // ],
        'columns' => array_merge(
            [
                // Other columns...
            'groupNo',
            'courseCode',
            'groupName',
            ],
            array_map(function($student) {
                return [
                    'label' => Yii::t('app', $student->fname . ' ' . $student->lname), // Customize the label as needed
                    'value' => function ($model) use ($student) {
                        foreach ($model->students as $modelStudent) {
                            if ($modelStudent->groupID == $student->groupID) {
                                return $modelStudent->regNo; // Display the registration number for the specific student
                            }
                        }
                        //return ; // Return an empty string if the student is not found
                    },
                ];
            }, $allStudents) // Assuming $allStudents is an array of all students
        ),
    ]); ?>

    <?php Pjax::end(); ?>

</div>
