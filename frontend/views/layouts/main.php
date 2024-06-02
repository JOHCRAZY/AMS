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
$this->registerJsFile('@web/js/site.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>" class="h-100" data-bs-theme="dark" data-bs-version="5.1">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags()?>
    <title><?=Html::encode($this->title)?></title>
    <?php $this->head()?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody()?>

<header>
    <?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => '#',
    'options' => [
        'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
    ],
]);
$menu = [
    ['label' => 'Home', 'url' => ['/site/index']],
];
$menuItems = [
    ['label' => 'Home', 'url' => ['/site/index']],
    //['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']],
    ['label' => 'Signup', 'url' => ['/site/signup']],

];
if (Yii::$app->user->isGuest) {
    // $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
} else {
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menu,
    ]);
}
echo Html::tag('div', '<i class="fas fa-book"> Assignment Management System </i>', ['class' => ['navbar-nav me-auto mb-2 mb-md-0']]);

if (Yii::$app->user->isGuest) {
    echo Html::tag('div', Html::a('<i class="fas fa-sign-in-alt">Login</i>', ['/site/login'], ['class' => ['btn btn-link']]), ['class' => ['d-flex']]);
} else {
    // echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
    // . Html::submitButton(
    //     'Logout (' . Yii::$app->user->identity->username . ')',
    //     ['class' => 'btn btn-link logout text-decoration-none']
    // )
    // . Html::endForm();
    echo '<ul class="nav-item">'
. Html::a('<i class="fas fa-sign-out-alt">Logout</i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link d-flex mt-3']);

}

NavBar::end();
?>

</header>

<!-- <div class="col d-flex flex-column align-items-stretch mt-4"> -->
<div class="row justify-content-between">
<!-- <div class="col-sm-1 order-0 p-4 position-sticky fixed"> -->
    <?php if (!Yii::$app->user->isGuest): ?>
        <?php
$user = \frontend\models\User::findByUsername(Yii::$app->user->identity->username);
if ($user !== null) {
    if ($user->role == 'student') {
        $student = \frontend\models\Student::find()->where(['UserID' => $user->UserID])->one();

        if ($student != null) {
            echo '<div class="col-sm-1 order-0 p-4 position-sticky fixed">'.$this->render('StudentSideNav').'</div>';
        } else {

            echo '<div class="col-sm-1 order-0 p-4 position-sticky fixed"><div class="card m-3 text-bg-warning-subtle p-3 text-center position-fixed">';
            echo '<span class="w-100">You\'re Not Yet Registered</span><br>';
            echo '<span class="w-100">Please fill Your Details</span>';
            echo '<br>';
            echo '<a href="' . Yii::$app->urlManager->createUrl(['student/profile']) . '">Register</a>';
            echo '</div></div>';

        }

    } elseif ($user->role == 'instructor') {
        $instructor = \frontend\models\Instructor::find()->where(['UserID' => $user->UserID])->one();
        if ($instructor !== null && $instructor->Status == 'Verified') {
            echo '<div class="col-sm-1 order-0 p-4 position-sticky fixed">'.$this->render('InstructorSideNav').'</div>';
        } else {


            echo '<div class="col-sm-1 order-0 p-4 position-sticky fixed"><div class="card m-3 text-bg-warning-subtle p-2 text-center mt-5 position-fixed">';
            echo '<span class="w-100">You\'re Not Yet Verified</span><br>';
            echo '<span class="w-100">Please fill Your Details and Contact Administrator for Verification</span>';
            echo '<a href="' . Yii::$app->urlManager->createUrl(['instructor/profile']) . '">Register</a>';
            echo '</div></div>';
        }
    }
}
?>
    <?php endif;?>
<!-- </div> -->


<div class="col-sm-10 order-1 p-4">
<main role="main" class="wrapper">


<div class="container w-100" data-bs-theme="dark">
    <?=Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => ['class' => 'bg-dark text-primary']
])?>

<div class="col text-lg-center">
<?=Alert::widget()?>

</div>
<?=$content?>
</div>
</main>
</div>
</div>
<!-- </div> -->


<footer class="footer mt-auto py-3 text-muted bg-dark sticky-bottom" style="color:aquamarine">
    <div class="container" style="color:aqua">
        <p class="float-start">&copy; <?=Html::encode(Yii::$app->name)?> <?=date('Y')?></p>
        <p class="float-end"><?='Assignment Management System'?></p>
    </div>
</footer>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage();
