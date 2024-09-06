<?php
use yii\helpers\Url;
?>
<aside class="main-sidebar elevation-2" style="width: 17%; height: 100vh;">
    <div class="sidebar mt-5 p-2 align-items-center">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-4 mb-2 ml-3 d-flex">
            <?php
            $student = frontend\models\Student::findOne(['userID' => Yii::$app->user->identity->getId()]);
            if ($student !== null && $student->profileImage !== null) {
                echo '<a href="'.Url::to(['student/profile']).'"><img src="' . Yii::$app->request->baseUrl . '/profiles/' . $student->profileImage . '" class="card rounded-2" style="width: 50px;"></a>';
            } else {
                echo 'Navigate';
            }
            ?>
            <div class="info mt-2">
                <a class="d-block"><?= Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- Sidebar Search Form -->
        <div class="form-inline ml-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="sidebar-menu nav-child-indent d-flex flex-column align-items-stretch mt-2">
            <?= \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'All Assignments',
                        'icon' => 'tasks',
                        'url' => Url::to(['/assignment/']),
                    ],
                    [
                        'label' => 'Assignments',
                        'icon' => 'clipboard-list',
                        'items' => [
                            [
                                'label' => 'Pending Assignments',
                                'icon' => 'clock',
                                'items' => [
                                    ['label' => 'Individual Assignments', 'icon' => 'user', 'url' => Url::to(['/assignment/individual']), 'iconStyle' => 'far'],
                                    ['label' => 'Group Assignments', 'icon' => 'users', 'url' => Url::to(['/assignment/group']), 'iconStyle' => 'far'],
                                ],
                            ],
                            [
                                'label' => 'Submitted Assignments',
                                'icon' => 'check',
                                'items' => [
                                    [
                                        'label' => 'Individual Assignments',
                                        'icon' => 'file-alt',
                                        'items' => [
                                            ['label' => 'Marked', 'icon' => 'check-circle', 'url' => Url::to(['/submission/individual-marked']), 'iconStyle' => 'far'],
                                            ['label' => 'Not Marked', 'icon' => 'exclamation-circle', 'url' => Url::to(['/submission/individual-not-marked']), 'iconStyle' => 'far'],
                                        ],
                                    ],
                                    [
                                        'label' => 'Group Assignments',
                                        'icon' => 'file-alt',
                                        'items' => [
                                            ['label' => 'Marked', 'icon' => 'check-circle', 'url' => Url::to(['/submission/group-marked']), 'iconStyle' => 'far'],
                                            ['label' => 'Not Marked', 'icon' => 'exclamation-circle', 'url' => Url::to(['/submission/group-not-marked']), 'iconStyle' => 'far'],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'label' => 'Group Members',
                        'icon' => 'users',
                        'url' => Url::to(['/groups/members']),
                    ],
                    [
                        'label' => 'Profile',
                        'icon' => 'user-circle',
                        'url' => Url::to(['/student/profile']),
                    ],
                ],
            ]) ?>
        </nav>
    </div>
</aside>

<!-- < ?php

use yii\helpers\Url;

?>
<>
<aside class="main-sidebar  elevation-2 align-items-center fixed" style="left: 0;">

    < !-- Sidebar - ->
    <div class="sidebar mt-5 p-2 align-items-center">
        < !-- Sidebar user panel (optional) -- 
        <div class="user-panel mt-4 mb-2 ml-3 d-flex">
        < ?php
$student = frontend\models\Student::findOne(['userID' => Yii::$app->user->identity->getId()]);
if ($student !== null && $student->profileImage !== null) {
    echo '<img src="' . Yii::$app->request->baseUrl . '/profiles/' . $student->profileImage . '" class="card rounded-4" style="width: 50px;">';
} else {
    echo 'Navigate';
}
?>
            <div class="info mt-2">
                <a class="d-block">< ?=Yii::$app->user->identity->username?></a>
            </div>
        </div>

        < !-- SidebarSearch Form -->
        <!-- href be escaped -- >
        <div class="form-inline ml-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        < !-- Sidebar Menu  mt-2-- >
        <nav class="sidebar-menu d-flex flex-column align-items-stretch">
            < ?php
echo \hail812\adminlte\widgets\Menu::widget([
    'items' => [
        [
            'label' => 'All Assignments', 'url' => Url::to(['/assignment/']),
        ],
        [
            'label' => 'Assignments',
             'icon' => 'tachometer-alt',
             'tag' => 'See all assignments',
             'badge' => '<span class="right badge badge-info">2</span>',
            'items' => [
                [
                    'label' => 'Pending Assignments',
                    'items' => [
                        ['label' => 'Individual Assignments', 'url' => Url::to(['/assignment/individual']), 'iconStyle' => 'far'],
                        ['label' => 'Group Assignments', 'url' => Url::to(['/assignment/group']), 'iconStyle' => 'far'],
                    ],
                ],
                [
                    'label' => 'Submitted Assignments',
                    'items' => [
                        [
                            'label' => 'Individual Assignments',
                            'items' => [
                                ['label' => 'Marked Individual Assignments', 'url' => Url::to(['/submission/individual-marked']), 'iconStyle' => 'far'],
                                ['label' => 'Not marked Individual Assignments', 'url' => Url::to(['/submission/individual-not-marked']), 'iconStyle' => 'far'],
                            ],
                        ],
                        [
                            'label' => 'Group Assignments',
                            'items' => [
                                ['label' => 'Marked Group Assignments', 'url' => Url::to(['/submission/group-marked']), 'iconStyle' => 'far'],
                                ['label' => 'Not marked Group Assignments', 'url' => Url::to(['/submission/group-not-marked']), 'iconStyle' => 'far'],
                            ],
                        ],

                    ],
                ],

            ],
        ],
        [
            'label' => 'Group Members',
            'url' => Url::to(['/groups/members']),
        ],
        [
            'label' => 'Profile',
            'url' => Url::to(['/student/profile']),
        ],
        // [
        //     'label' => 'Logout',
        //      'url' => Url::to(['site/logout']),
        //      'data-method' => 'post',
        //       'visible' => !Yii::$app->user->isGuest
        // ],
    ],
]);
?>
        </nav>
        < !-- /.sidebar-menu -- >
    </div>
    <! -- /.sidebar -- >
</aside>
</>




< !-- < ?php
use frontend\models\Student;
use yii\helpers\Url;
?>

<nav class="m-4 text-center position-fixed bg-light p-1" aria-label="Sidebar navigation" style="max-height: 100%;">


<ul class="">
  <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#sidenav" aria-expanded="false" aria-controls="pendingAssignments">
        < ?php
        $student = Student::findOne(['userID' => Yii::$app->user->identity->getId()]);
        if ($student !== null && $student->profileImage !== null) {
            echo '<img src="' . Yii::$app->request->baseUrl . '/profiles/' . $student->profileImage . '" class="card rounded-4" style="width: 50px;">';
        } else {
            echo 'Navigate';
        }
        ?>

  </a>
  <div class="card collapse elevation-5" id="sidenav">
    <ul class="nav flex-column  mt-3">
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="< ?= Url::to(['/assignment/']) ?>">All Assignments</a>
        </li>
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#pendingAssignments" aria-expanded="false" aria-controls="pendingAssignments">Pending Assignments</a>
            <div class="collapse" id="pendingAssignments">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="< ?= Url::to(['/assignment/individual']) ?>">Individual Assignment</a>
                    </li>
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="< ?= Url::to(['/assignment/group']) ?>">Group Assignment</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submittedAssignments" aria-expanded="false" aria-controls="submittedAssignments">Submitted Assignments</a>
            <div class="collapse" id="submittedAssignments">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#individualSubmitted" aria-expanded="false" aria-controls="individualSubmitted">Individual Assignment</a>
                        <div class="collapse" id="individualSubmitted">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item border-bottom border-primary">
                                    <a class="nav-link" href="< ?= Url::to(['/submission/individual-marked']) ?>">Marked</a>
                                </li>
                                <li class="nav-item border-bottom border-primary">
                                    <a class="nav-link" href="< ?= Url::to(['/submission/individual-not-marked']) ?>">Not Marked</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#groupSubmitted" aria-expanded="false" aria-controls="groupSubmitted">Group Assignment</a>
                        <div class="collapse" id="groupSubmitted">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item border-bottom border-primary">
                                    <a class="nav-link" href="< ?= Url::to(['/submission/group-marked']) ?>">Marked</a>
                                </li>
                                <li class="nav-item border-bottom border-primary">
                                    <a class="nav-link" href="< ?= Url::to(['/submission/group-not-marked']) ?>">Not Marked</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="< ?= Url::to(['groups/members']) ?>">Group Members</a>
        </li>
        <li class="nav-item border-bottom border-primary ">
            <a class="nav-link" href="< ?= Url::to(['/student/profile']) ?>">Profile</a>
        </li>
    </ul>
    </div>
    </ul>
</nav>

<style>
  /* .nav-link {
    color: #000;
  } */
  .nav{
        align-items: start;
        justify-content: start;
    }
  .nav-link:hover {
    color: green;
  }
  .border-bottom {
    border-bottom: 1px solid;
  }
  .nav-item .collapse {
    background-color: white;
  }
</style> --> -->
