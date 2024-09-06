<?php 

use yii\helpers\Html;
?>

<footer class="footer p-1 text-muted bg-dark fixed-footer" style="color:aquamarine">
    <div class="container" style="color:aqua">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end">Assignment Management System</p>
    </div>
</footer>


<style>
.fixed-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 35px;
    /*z-index: 1000; /* Ensure it appears above other elements if needed */
}
</style>