<?php

/** @var yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Html;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Nav;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'imageFile/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name." ( STUDENT )",
        'brandUrl' => '#',
        'options' => ['class' => 'nav navbar-dark bg-dark'],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'nav justify-content-center navbar-dark bg-dark'],
        'items' => [
            ['label' => 'Home', 'url' => ['/student/index']],
            ['label' => 'About', 'url' => ['/student/about']],
            ['label' => 'Contact', 'url' => ['/student/contact']],
            '<li class="nav-link">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>',            
        ]
    ]);
    NavBar::end();
    ?>
</div>
<div class="d-flex flex-column align-items-stretch mt-5">
  <div class="row">
    <div class="col-md-2 order-1 p-3">
      One of three columns
      <?php
echo SideNav::widget([
    // 'options' => [
    //     'class' => '',
    // ],
    'type' => SideNav::TYPE_SUCCESS,
    'encodeLabels' => false,
    'items' => [
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default action is used.
        //
        // NOTE: The variable `$item` is specific to this demo page that determines
        // which menu item will be activated. You need to accordingly define and pass
        // such variables to your view object to handle such logic in your application
        // (to determine the active status).
        //
        ['label' => 'Home', 'active' => true,
         'items' => [
            ['label' => 'Books', 'items' => [
                ['label' => '<span class="pull-right float-right float-end badge">10</span> New Arrivals', 'url' => ['/site/new-arrivals'], 'active' =>  false],
                ['label' => '<span class="pull-right float-right float-end badge">5</span> Most Popular', 'url' => ['/site/most-popular'], 'active' =>  false],
                ['label' => 'Read Online', 
                 'items' => [
                    ['label' => 'Online 1', 'url' => ['/site/online-1'], 'active' => false],
                    ['label' => 'Online 2', 'url' => ['/site/online-2'], 'active' => false]
                ]],
            ]],
            ['label' => '<span class="pull-right float-right float-end badge">3</span> Categories',
             'items' => [
                ['label' => 'Fiction', 'url' => ['/site/fiction'], 'active' => false],
                ['label' => 'Historical', 'url' => ['/site/historical'], 'active' => false],
                ['label' => '<span class="pull-right float-right float-end badge">2</span> Announcements',
                 'items' => [
                    ['label' => 'Event 1', 'url' => ['/site/event-1'], 'active' => false],
                    ['label' => 'Event 2', 'url' => ['/site/event-2'], 'active' => false]
                ]],
            ]],
            ['label' => 'Profile', 'url' => yii::$app->user->isGuest ? ['/site/login'] : ['/student/profile'], 'active' => false]
        ]],
        
    ],
]);        
?>
    </div>
    <div class="col order-2">
      Two of three columns
      <?= $content ?>

    </div>
    <?php if (Yii::$app->session->hasFlash('editor')): ?>
    <div class="col order-3">
      Three of three columns
      <?= $content ?>
    
    </div>
    <?php endif; ?>

  </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>