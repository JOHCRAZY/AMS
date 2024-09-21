<?php 
use edofre\fullcalendar\Fullcalendar;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'AMS | Calendar';
?>

    <?= Fullcalendar::widget([
         'options'       => [
            'id'       => 'calendar',
            'language' => 'en',
            'class' => 'bg-light',
        ],
        'clientOptions' => [
            'weekNumbers' => true,
            'selectable'  => true,
        'editable' => true,
        'events' => Url::to(['calendar/events']),
    ],
    ]);