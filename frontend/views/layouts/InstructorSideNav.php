<?php
use yii\helpers\Url;
?>
<aside class="main-sidebar nav-sidebar elevation-2" style="width: 17%; height: 100vh;">
    <div class="sidebar mt-5 align-items-center">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-4 mb-2 ml-3 d-flex">
            <?php
$instructor = frontend\models\Instructor::findOne(['UserID' => Yii::$app->user->identity->getId()]);
if ($instructor !== null && $instructor->profileImage !== null) {
                echo '<img src="' . Yii::$app->request->baseUrl . '/profiles/' . $instructor->profileImage . '" class="card rounded-4" style="width: 50px;">';
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
        <nav class="sidebar-menu d-flex flex-column align-items-stretch mt-2">
            <?= \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Create New Assignment',
                        'icon' => 'plus',
                        'url' => Url::to(['/assignment/create']),
                    ],
                    [
                        'label' => 'View Assignments',
                        'icon' => 'tasks',
                        'items' => [
                            [
                                'label' => 'All Assignments',
                                'icon' => 'list',
                                'url' => Url::to(['/assignment/']),
                            ],
                            [
                                'label' => 'Individual Assignments',
                                'icon' => 'user',
                                'url' => Url::to(['/assignment/i']),
                            ],
                            [
                                'label' => 'Group Assignments',
                                'icon' => 'users',
                                'url' => Url::to(['/assignment/g']),
                            ],
                            
                        ],
                    ],
                    [
                        'label' => 'Submitted Assignments',
                        'icon' => 'clipboard-check',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Individual Assignments',
                                'icon' => 'user',
                                'url' => '#',
                                'items' => [
                                    [
                                        'label' => 'Marked',
                                        'icon' => 'check-circle',
                                        'url' => Url::to(['/submission/individual-marked']),
                                    ],
                                    [
                                        'label' => 'Not Marked',
                                        'icon' => 'exclamation-circle',
                                        'url' => Url::to(['/submission/individual-not-marked']),
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Group Assignments',
                                'icon' => 'users',
                                'url' => '#',
                                'items' => [
                                    [
                                        'label' => 'Marked',
                                        'icon' => 'check-circle',
                                        'url' => Url::to(['/submission/group-marked']),
                                    ],
                                    [
                                        'label' => 'Not Marked',
                                        'icon' => 'exclamation-circle',
                                        'url' => Url::to(['/submission/group-not-marked']),
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'label' => 'Mark Assignments',
                        'icon' => 'marker',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Individual Assignments',
                                'icon' => 'user',
                                'url' => Url::to(['/submission/mark-individual']),
                            ],
                            [
                                'label' => 'Group Assignments',
                                'icon' => 'users',
                                'url' => Url::to(['/submission/mark-group']),
                            ],
                        ],
                    ],
                    [
                        'label' => 'Marked Assignments',
                        'icon' => 'check',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Individual Assignments',
                                'icon' => 'user',
                                'url' => Url::to(['/submission/individual-marked']),
                            ],
                            [
                                'label' => 'Group Assignments',
                                'icon' => 'users',
                                'url' => Url::to(['/submission/group-marked']),
                            ],
                        ],
                    ],
                    [
                        'label' => 'Track Assignments',
                        'icon' => 'fas fa-calendar', 
                        'url' => Url::to(['/calendar/']),
                    ],
                    [
                        'label' => 'Student Groups',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Create New Groups',
                                'icon' => 'plus',
                                'url' => Url::to(['/groups/create']),
                            ],
                        ],
                    ],
                    [
                        'label' => 'Profile',
                        'icon' => 'user',
                        'url' => Url::to(['/instructor/profile']),
                    ],
                    
                ],
                
            ]) ?>
            
        </nav>

    </div>
</aside>






<!--
'<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                  <i class="fas fa-th-large"></i>
              </a>'
               -->
