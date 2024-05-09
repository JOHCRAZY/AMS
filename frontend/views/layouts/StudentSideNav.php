<aside class="main-sidebar sidebar-dark-primary elevation-1">
<nav class="d-flex flex-column mt-4 position-fixed">
    <?php
    use kartik\sidenav\SideNav;
    $student = frontend\models\Student::findOne(['userID' => Yii::$app->user->identity->getId()]);
echo SideNav::widget([
    'options' => [
        'class' => 'card m-3 p-0 text-center position-fixed',
    ],
    'type' => SideNav::TYPE_SUCCESS,
    'encodeLabels' => false,
    'items' => [
         ['label' => $student !== null ? '<img src="'.Yii::$app->request->baseUrl."/".$student->profileImage.'" class="img-circle rounded-4 elevation-2 pull-right" style="width: 45px;">' : 'Navigate',
            'items' => [
                ['label' => 'All Assignments', 'url' => ['/assignment/'], 'active' =>  false],
                ['label' => '<span class="pull-right float-right float-end badge"> </span>Pending Assignments',
                 'items' => [
                    ['label' => '<span class="pull-right float-right float-end badge"> </span> Individual Assignment', 'url' => ['/assignment/individual'], 'active' => false],
                    ['label' => '<span class="pull-right float-right float-end badge"> </span> Group Assignment', 'url' => ['/assignment/group'], 'active' => false],
                ]],
                ['label' => '<span class="pull-right float-right float-end badge"> </span> Submitted Assignments',
                    'items' => [
                        ['label' => 'Individual Assignment', 'active' => false,
                            'items' => [
                                ['label' => 'Marked', 'url' => ['/submission/individual-marked'], 'active' => false],
                                ['label' => 'Not Marked', 'url' => ['/submission/individual-not-marked'], 'active' => false],
                            ]],
                        ['label' => 'Group Assignment','active' => false,
                            'items' => [
                                ['label' => 'Marked', 'url' => ['/submission/group-marked'], 'active' => false],
                                ['label' => 'Not Marked', 'url' => ['/submission/group-not-marked'], 'active' => false],
                            ]],
                    ]],
                    ['label' => '<span class="pull-right float-right float-end badge">  </span>Group Members','url' => ['groups/members']],

                ['label' => 'Profile', 'url' => ['/student/profile'], 'active' => false],
                ['label' => 'Select Course', 'url' => ['/course/'],],
            ]],

    ],
]);
?>

</nav>
</aside>

