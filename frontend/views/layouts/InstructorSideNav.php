<aside class="main-sidebar sidebar-dark-primary elevation-1">
<nav class="d-flex flex-column align-items-end mt-4 position-fixed">
<?php
    use kartik\sidenav\SideNav;
    $instructor = frontend\models\Instructor::findOne(['UserID' => Yii::$app->user->identity->getId()]);
echo SideNav::widget([
    'options' => [
        'class' => 'card m-3 p-0 text-center position-fixed',
    ],
    'type' => SideNav::TYPE_SUCCESS,
    'encodeLabels' => false,
    'items' => [
        ['label' => $instructor !== null ? '<img src="'.Yii::$app->request->baseUrl."/".$instructor->profileImage.'" class="img-circle rounded-4 elevation-2 pull-right" style="width: 45px;">' : 'Navigate',
         'items' => [
            ['label' => 'View Assignments',
             'items' => [
                ['label' => 'All Assignment', 'url' => ['/assignment/'], 'active' =>  false],
                ['label' => 'Create New Assignment', 'url' => ['/assignment/create'], 'active' =>  false],
            ]],
            ['label' => '<span class="pull-right float-right float-end badge">3</span> Submitted Assignments',
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
            ['label' => 'Mark Assignments',
             'items' => [
                ['label' => 'Individual Assignments', 'url' => ['/submission/individual-not-marked'], 'active' => false],
                ['label' => 'Group Assignments', 'url' => ['/submission/group-not-marked'], 'active' => false],
            ]],
            ['label' => 'Marked Assignments',
            'items' => [
                ['label' => 'Individual Assignments', 'url' => ['/submission/individual-marked'], 'active' => false],
                ['label' => 'Group Assignments', 'url' => ['/submission/group-marked'], 'active' => false],
            ]],
            ['label' => 'Student groups',
            'items' => [
                ['label' => 'Create New Groups', 'url' => ['/groups/create'], 'active' => false],
                ['label' => 'All Students', 'url' => ['/groups/students'], 'active' => false],
            ]],
            ['label' => 'Profile', 'url' => ['/instructor/profile'], 'active' => false],
        ]],
        
    ],
]);        
?>

</nav>
</aside>
