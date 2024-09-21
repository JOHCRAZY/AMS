<?php

use yii\helpers\Html;
use yii\bootstrap5\Modal;

/** @var  yii\web\View $this*/
/** @var $dataProvider yii\data\ActiveDataProvider */
/** @var $programmeCode string */

$this->title = 'Select Course';
$this->params['breadcrumbs'][] = ['label' => 'Programmes', 'url' => ['programme/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Select Course
</button>
