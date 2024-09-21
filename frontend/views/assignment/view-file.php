<?php 
$this->title = 'Attachment';
?>
<iframe src="<?= Yii::getAlias('@web') ?>/assignment/load-file?filePath=<?= urlencode($filePath) ?>" width="100%" height="700"></iframe>
