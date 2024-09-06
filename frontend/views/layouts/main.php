<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

use \hail812\adminlte3\assets\FontAwesomeAsset;
FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);

$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->request->baseUrl;

$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
$this->registerJsFile($publishedRes[1] . '/control_sidebar.js', ['depends' => '\hail812\adminlte3\assets\AdminLteAsset']);

?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags()?>
    <title><?=Html::encode($this->title)?></title>
    <?php $this->head()?>
</head>
<body class="container-fluid hold-transition nav-child-indent layout-fixed mb-4 mt-2">
<?php $this->beginBody()?>

<header>
    
    <?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => '#',
    'options' => [
        'class' => 'navbar navbar-expand navbar-primary fixed-top elevation-5',
    ],
]);

echo '<a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i>
            </a>';



$menuItems = [
    ['label' => 'Home', 'url' => ['/site/index']],
    ['label' => 'Contact', 'url' => ['/site/contact']],
    ['label' => 'Signup', 'url' => ['/site/signup']],
];

echo Nav::widget([
    'options' => ['class' => 'navbar-nav m-auto mb-2 mb-md-0'],
    'items' => Yii::$app->user->isGuest ? $menuItems : [
       // ['label' => 'Home', 'url' => ['/site/index']],
    ],
]);

//echo Html::tag('div', '<i class="fas fa-book"> Assignment Management System </i>', ['class' => 'navbar-nav me-auto mb-2 mb-md-0']);

if (Yii::$app->user->isGuest) {
    echo Html::tag('div', Html::a('<i class="fas fa-sign-in-alt"> Login</i>', ['/site/login'], ['class' => 'btn btn-link']), ['class' => 'd-flex']);
} else {
    

    echo '<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                  <i class="fas fa-cog"></i>
              </a>';
              echo '<a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
          </a>';
    echo Html::a('<i class="fas fa-sign-out-alt"> Logout</i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link d-flex ']);
}

NavBar::end();
?>
</header>

<div class="container-fluid">
    <div class="row row-cols-auto gap-0">
        <?php if(!Yii::$app->user->isGuest): ?>
        <div class="col order-0">
        <?=$this->render('sideNav', ['assetDir' => $assetDir])?>
            <?php $class = 'col-10';?>
        </div>
        <?php else: ?>
          <?php   $class = 'col'; ?>
        <?php endif; ?>
        <!-- <div class="< ?=$class ?>"> -->
    <?=$this->render('control-sidebar')?>

    <main role="main" class="<?=$class ?> container-fluid mb-4">
        <div class="container-fluid">
            <?=Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => ['class' => 'bg-dark text-primary'],
])?>
            <div class="col text-lg-center mt-2 elevation-5">
                <?=Alert::widget()?>
            </div>
            <?=$content?>
        </div>
    </main>
        <!-- </div> -->
    </div>
</div>

<?=$this->render('footer')?>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
