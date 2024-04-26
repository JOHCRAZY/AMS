<aside class="main-sidebar sidebar-dark-primary elevation-1">
<nav class="d-flex flex-column align-items-end mt-4 position-fixed">
<?php
    use kartik\sidenav\SideNav;
echo SideNav::widget([
    'options' => [
        'class' => '',
    ],
    'type' => SideNav::TYPE_SUCCESS,
    'encodeLabels' => false,
    'items' => [
        ['label' => 'Navigate','class' => 'nav-link', 'active' => false,
         'items' => [
            ['label' => '<span class="pull-right float-right float-end badge">3</span>New Assignments',
             'items' => [
                ['label' => '<span class="pull-right float-right float-end badge">10</span> Individual Assignment', 'url' => ['/assignment/individual'], 'active' =>  false],
                ['label' => '<span class="pull-right float-right float-end badge">5</span> Group Assignment', 'url' => ['/assignment/group'], 'active' =>  false],
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
