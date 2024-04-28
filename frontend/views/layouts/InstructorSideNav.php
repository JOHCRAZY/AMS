<aside class="main-sidebar sidebar-dark-primary elevation-1">
<nav class="d-flex flex-column align-items-end mt-4 position-fixed">
<?php
    use kartik\sidenav\SideNav;
    $instructor = frontend\models\Instructor::findOne(['UserID' => Yii::$app->user->identity->getId()]);
echo SideNav::widget([
    'options' => [
        'class' => '',
    ],
    'type' => SideNav::TYPE_SUCCESS,
    'encodeLabels' => false,
    'items' => [
        ['label' => $instructor !== null ? '<img src="'.Yii::$app->request->baseUrl."/".$instructor->profileImage.'" class="img-circle elevation-2 pull-right" style="width: 45px;">' : 'Navigate',
         'items' => [
            ['label' => '<span class="pull-right float-right float-end badge">3</span>Assignments',
             'items' => [
                ['label' => '<span class="pull-right float-right float-end badge">10</span>All Assignment', 'url' => ['/assignment/'], 'active' =>  false],
                ['label' => '<span class="pull-right float-right float-end badge">5</span>New Assignment', 'url' => ['/assignment/create'], 'active' =>  false],
            ]],
            ['label' => '<span class="pull-right float-right float-end badge">3</span> Submitted Assignments',
             'items' => [
                ['label' => 'Individual Assignment', 'url' => ['/submissions/individual'], 'active' => false],
                ['label' => 'Group Assignment', 'url' => ['/submissions/group'], 'active' => false],
            ]],
            ['label' => 'Profile', 'url' => ['/instructor/profile'], 'active' => false]
        ]],
        
    ],
]);        
?>
</nav>
</aside>
