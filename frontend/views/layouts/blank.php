<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="container">
<?php $this->beginBody() ?>
<div class="row justify-content-center p-2">
<div class="card elevation-5 rounded-5 m-5 shadow-sm">
<?= $content ?>
</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();