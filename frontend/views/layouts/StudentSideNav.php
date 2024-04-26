<aside class="main-sidebar sidebar-dark-primary elevation-1">
<nav class="d-flex flex-column align-items-end mt-4 position-fixed">
    <?php
    use kartik\sidenav\SideNav;
    use yii\helpers\Html;
    $student = frontend\models\Student::findOne(['userID' => Yii::$app->user->identity->getId()]);
    // Yii::$app->user->identity->;
echo SideNav::widget([
    'options' => [
        'class' => 'd-flex flex-column align-items-stretch',
    ],
    'type' => SideNav::TYPE_SUCCESS,
    'encodeLabels' => false,
    'items' => [
        ['label' => $student !== null ? '<img src="'.$student->profileImage.'" class="img-circle elevation-2 pull-right" style="width: 45px;">' : 'Navigate',
            'items' => [
                ['label' => '<span class="pull-right float-right float-end badge">3</span>Pending Assignments',
                 'items' => [
                    ['label' => '<span class="pull-right float-right float-end badge">10</span> Individual Assignment', 'url' => ['/assignment/individual'], 'active' => false],
                    ['label' => '<span class="pull-right float-right float-end badge">5</span> Group Assignment', 'url' => ['/assignment/group'], 'active' => false],
                ]],
                ['label' => '<span class="pull-right float-right float-end badge">3</span> Submitted Assignments',
                    'items' => [
                        ['label' => 'Individual Assignment', 'active' => false,
                            'items' => [
                                ['label' => 'Marked', 'url' => ['/submission/individual'], 'active' => false],
                                ['label' => 'Not Marked', 'url' => ['/submission/individual'], 'active' => false],
                            ]],
                        ['label' => 'Group Assignment','active' => false,
                            'items' => [
                                ['label' => 'Marked', 'url' => ['/submission/group'], 'active' => false],
                                ['label' => 'Not Marked', 'url' => ['/submission/group'], 'active' => false],
                            ]],
                    ]],
                    ['label' => '<span class="pull-right float-right float-end badge">3</span>Group Members','url' => ['groups/']],

                ['label' => 'Profile', 'url' => ['/student/profile'], 'active' => false],
            ]],

    ],
]);
?>
</nav>
</aside>
