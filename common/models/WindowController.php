<?php 
namespace common\models;
use Yii;
use yii\helpers\Url;

trait WindowController{
//     public function beforeAction($action)
// {
//     if (parent::beforeAction($action)) {
//         $minWidth = 50;
//         if (Yii::$app->request->isAjax) {
//             return true;
//         }

//         if (Yii::$app->request->isGet && !Yii::$app->request->isPjax) {
//             $this->view->registerJs("
//                 if (window.innerWidth < $minWidth) {
//                     window.location.href = '" . Url::to(['site/small-screen']) . "';
//                 }
//             ");
//         }

//         return true;
//     }

//     return false;
// }
}