<?php
use yii;

$datetime1 = new DateTime('2009-10-11 12:12:00');
$datetime2 = new DateTime('2009-10-12 12:12:00');

$interval = $datetime1->diff($datetime2);
echo $interval->s;
echo "\n";
echo "DS1 = ".$datetime1->getTimestamp()."\n";
echo "DS2 = ".$datetime2->getTimestamp()."\n";
$diff = $datetime1->getTimestamp() - $datetime2->getTimestamp();
echo "DIFF = ".$diff."\n";


$dateTime = new DateTime(yii::$app->formatter->asDatetime(time()));
echo $dateTime->getTimestamp();