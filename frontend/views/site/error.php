<?php 

use yii\helpers\Html;
use yii\helpers\Url;

/** @var  yii\web\View $this */
/** @var $name string */
/** @var $message string */
/** @var $exception Exception */


$this->title = 'AMS | Error';

?>
<div class="container-fluid p-3">

<div class="card  mt-5 alert alert-danger text-center">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <div class="alert alert-info">
        <h2 class="text-center"><p><?= Yii::t('app', 'Oops! Something went wrong.') ?></p></h2>
        
        <p><?= Yii::t('app', 'We\'re sorry, but it seems like there was an error processing your request. Our team has been notified of this issue and will work to resolve it as soon as possible.') ?></p>
        <p><?= Yii::t('app', 'In the meantime, here are a few things you can try:') ?></p>
        <ul class="text">
        <li><?= Yii::t('app', 'Check Your Internet Connection: ') ?> <?= Yii::t('app', 'Ensure you\'re connected to the internet and try again.') ?></li>
            <li><?= Yii::t('app', 'Reload the Page: - - ') ?> <?= Html::a(Yii::t('app', 'Refresh'), null, ['onclick' => 'window.location.reload(); return false;']) ?></li>
            <li><?= Yii::t('app', 'Go Back to the Previous Page: - - ') ?> <?= Html::a(Yii::t('app', 'Go Back'),null,['onclick' => 'javascript:history.back();']) ?></li>
            <li><?= Yii::t('app', 'Contact Support: - - ') ?> <?= Html::a(Yii::t('app', 'Contact Support'), Url::to(['site/contact'])) ?></li>
        </ul>
        <p><?= Yii::t('app', 'If you continue to encounter problems, please try again later. We apologize for any inconvenience this may have caused.') ?></p>
    </div>
</div>
