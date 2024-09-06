<?php
use \yii\helpers\Html;
/** @var $this yii\web\View */

$this->title = 'Screen Size Too Small';
$this->registerCss("
    .site-small-screen {
        text-align: center;
        margin-top: 50px;
        font-family: Arial, sans-serif;
    }
    .site-small-screen h1 {
        font-size: 24px;
        color: #d9534f;
    }
    .site-small-screen p {
        font-size: 18px;
        color: #5bc0de;
    }
    .site-small-screen .instructions {
        font-size: 16px;
        margin-top: 20px;
        color: #5bc0de;
    }
    .site-small-screen .button {
        margin-top: 30px;
        padding: 10px 20px;
        background-color: #5bc0de;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
    }
    .site-small-screen .button:hover {
        background-color: #31b0d5;
    }
");
?>

<div class="site-small-screen">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Your screen size is too small to access this application.</p>
    <p>Please use a device with a larger screen.</p>
    <div class="instructions">
        <p>For the best experience, please use one of the following options:</p>
        <ul>
            <li>Switch to a tablet or desktop computer.</li>
            <li>Rotate your device to landscape mode (if applicable).</li>
            <li>Increase your browser window size if possible.</li>
        </ul>
    </div>
    <a href="javascript:window.history.back();" class="button">Go Back</a>
</div>
