<?php

/** @var yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use kartik\sidenav\SideNav;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'imageFile/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <title><?=Html::encode($this->title)?></title>
    <?php $this->head()?>
</head>
<body>
<?php $this->beginBody()?>

<?php
NavBar::begin([
    'brandLabel' => Yii::$app->name . " ( STUDENT )",
    'brandUrl' => '#',
    'options' => ['class' => 'nav navbar-dark bg-dark'],
]);
echo Nav::widget([
    'options' => ['class' => 'nav justify-content-center navbar-dark bg-dark'],
    'items' => [
        ['label' => 'Home', 'url' => ['/student/index']],
        '<li class="nav-link">'
        . Html::beginForm(['/site/logout'])
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'nav-link btn btn-link logout']
        )
        . Html::endForm()
        . '</li>',
    ],
]);
NavBar::end();
?>
</div>
<div class="d-flex flex-column align-items-stretch mt-5">
  <div class="row">
    <div class="col-md-2 order-1 p-3 position-sticky" style="overflow-y: hidden;">
      <?php
echo SideNav::widget([
    'options' => [
        'class' => '',
    ],
    'type' => SideNav::TYPE_SUCCESS,
    'encodeLabels' => false,
    'items' => [
        ['label' => 'Home', 'active' => false,
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
    </div>
    <div class="col order-2">
      Two of three columns
      <?=$content?>

    </div>

  </div>
</div>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>