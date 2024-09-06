<?php

/** @var $this \yii\web\View */
/** @var $content string */

use yii\helpers\Html;
//use backend\assets\AppAsset;

use \hail812\adminlte3\assets\FontAwesomeAsset;
FontAwesomeAsset::register($this);
//AppAsset::register($this);

\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->request->baseUrl;// Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
$this->registerJsFile($publishedRes[1].'/control_sidebar.js', ['depends' => '\hail812\adminlte3\assets\AdminLteAsset']);
?>
<?php $this->beginPage() ?>
<!-- <!DOCTYPE html> -->
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper m-5" style="top: 0;">
    <!-- Navbar -->
   <div class="container">
   <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
   </div>
    <!-- /.navbar
<div class="row w-100">
<div class="col-sm-6 mb-3 mb-sm-0 w-50 align-end">
< ?=common\widgets\Alert::widget()?>
</div>
</div> -->
    <!-- Main Sidebar Container -->
    <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
</div>
<div class="row">
    <?= $this->render('footer') ?>
</div>
<?php $this->endBody() ?>
</body>
<!-- </html> -->
<?php $this->endPage() ?>


