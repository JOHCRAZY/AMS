<?php
namespace frontend\components;

use yii\web\ErrorHandler;

class CustomErrorHandler extends ErrorHandler
{
    public function renderException($exception)
    {
        if ($exception instanceof \yii\base\ErrorException && strpos($exception->getMessage(), 'Attempt to read property') !== false) {
            // Handle the specific error here
            \Yii::error('Attempt to read property on null: ' . $exception->getMessage());
            // You can log, redirect, or handle it however you see fit
            // For example, redirect to a specific error page
            return \Yii::$app->getResponse()->redirect(['/site/error']);
        }

        // Call the parent method to handle other exceptions
        return parent::renderException($exception);
    }
}
