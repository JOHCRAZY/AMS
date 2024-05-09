<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <?='<img src="'.$assetDir.'/uploads/johcrazy.png'.'" alt="profile image">'?>
                <!-- <img src="".Yii::$app->request->baseUrl."/uploads/eastc.png" class="img-circle elevation-2" alt="< ?= Yii::$app->request->baseUrl ?>"> -->
            </div>
            <div class="info">
                <a class="d-block"><?= Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu  mt-2-->
        <nav class="d-flex flex-column align-items-stretch mt-5">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Admins',
                        // 'icon' => 'tachometer-alt',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'All Admins', 'url' => ['admin/'], 'iconStyle' => 'far'],
                            ['label' => 'Add Admin', 'url' => ['admin/create'], 'iconStyle' => 'far'],

                        ]
                    ],
                    [
                        'label' => 'Students',
                        // 'icon' => 'tachometer-alt',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'All Students', 'url' => ['student/'], 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Instructors',
                        // 'icon' => 'tachometer-alt',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'All Instructors', 'url' => ['instructor/'], 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Programmes',
                        // 'icon' => 'tachometer-alt',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'All Programmes', 'url' => ['programme/'], 'iconStyle' => 'far'],
                            ['label' => 'New Programme', 'url' => ['programme/create'], 'iconStyle' => 'far'],

                        ]
                    ],
                    [
                        'label' => 'Courses',
                        // 'icon' => 'tachometer-alt',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'All Courses', 'url' => ['course/'], 'iconStyle' => 'far'],
                            ['label' => 'Add New Coarse', 'url' => ['course/create'], 'iconStyle' => 'far'],

                        ]
                    ],
                    [
                        'label' => 'Student Groups',
                        // 'icon' => 'tachometer-alt',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'All Groups', 'url' => ['group/'], 'iconStyle' => 'far'],
                            ['label' => 'create New group', 'url' => ['group/create'], 'iconStyle' => 'far'],

                        ]
                    ],
                    [
                        'label' => 'Assignments',
                        // 'icon' => 'tachometer-alt',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'All Assignments', 'url' => ['assignment/'], 'iconStyle' => 'far'],
                        ]
                    ],
                    
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>