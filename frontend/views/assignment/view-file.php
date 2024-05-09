<?php 

?>
<main class="container w-100">
    <p class="text-center">Preview</p>
<iframe src="<?= Yii::getAlias('@web') ?>/assignment/load-file?filePath=<?= urlencode($filePath) ?>" width="100%" height="700"></iframe>
</main>