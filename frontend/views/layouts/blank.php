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
<body style="margin:0px; background-color: rgb(82, 86, 89);">
<?php $this->beginBody() ?>
    <!-- <div class="text-lg-center mt-5 w-25"> -->
    <!-- </div> -->

<!-- <div class="row justify-content-between p-2"> -->
<?= $content ?>
<!-- </div> -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();