<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Admin Dashboard';
?>

<div class="admin-dashboard">

    <header class="jumbotron text-center">
        <h1><?= Html::encode($this->title) ?></h1>
        <p class="lead">Welcome to the Admin Dashboard. Manage your system efficiently.</p>
    </header>

    <main class="container">

        <section class="row features">
            <div class="col-md-4">
                <!-- < ?= Html::icon('users-cog') ?> -->
                <h3>User Management</h3>
                <p>Manage user accounts, roles, and permissions. Create, edit, or delete user profiles as needed.</p>
                <?= Html::a('Manage Users', ['/admin/user-management'], ['class' => 'btn btn-outline-primary']) ?>
            </div>
            <div class="col-md-4">
                <!-- < ?= Html::icon('cogs') ?> -->
                <h3>System Settings</h3>
                <p>Configure system settings, including email notifications, security options, and other global settings.</p>
                <?= Html::a('Configure Settings', ['/admin/system-settings'], ['class' => 'btn btn-outline-primary']) ?>
            </div>
            <div class="col-md-4">
                <!-- < ?= Html::icon('database') ?> -->
                <h3>Data Management</h3>
                <p>Manage data, including backups, imports, exports, and database maintenance tasks.</p>
                <?= Html::a('Manage Data', ['/admin/data-management'], ['class' => 'btn btn-outline-primary']) ?>
            </div>
        </section>

        <hr class="my-5">

        <section class="row tools">
            <div class="col-md-6">
                <h2>Tools</h2>
                <ul>
                    <li><a href="#">System Logs</a></li>
                    <li><a href="#">Activity Monitoring</a></li>
                    <li><a href="#">Error Tracking</a></li>
                    <li><a href="#">Performance Analysis</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2>Reports</h2>
                <ul>
                    <li><a href="#">User Activity Report</a></li>
                    <li><a href="#">System Usage Statistics</a></li>
                    <li><a href="#">Data Integrity Report</a></li>
                    <li><a href="#">Security Audit Report</a></li>
                </ul>
            </div>
        </section>

        <hr class="my-5">

        <section class="row">
            <div class="col-md-6">
                <h2>Documentation</h2>
                <p>Access documentation and guides for system administration tasks. Learn how to effectively manage the system.</p>
                <?= Html::a('View Documentation', ['/admin/documentation'], ['class' => 'btn btn-secondary']) ?>
            </div>
            <div class="col-md-6">
                <h2>Support</h2>
                <p>Need assistance? Contact our support team for help with any technical issues or questions.</p>
                <?= Html::a('Contact Support', ['/admin/support'], ['class' => 'btn btn-secondary']) ?>
            </div>
        </section>

    </main>

</div>





<!-- < ?php
$this->title = 'AMS | ADMIN';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            < ?= \hail812\adminlte\widgets\Alert::widget([
                'type' => 'success',
                'body' => '<h3>Congratulations!</h3>',
            ]) ?>
            < ?= \hail812\adminlte\widgets\Callout::widget([
                'type' => 'danger',
                'head' => 'I am a danger callout!',
                'body' => 'There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            < ?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'CPU Traffic',
                'number' => '10 <small>%</small>',
                'icon' => 'fas fa-cog',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            < ?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Messages',
                'number' => '1,410',
                'icon' => 'far fa-envelope',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            < ?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Bookmarks',
                'number' => '410',
                 'theme' => 'success',
                'icon' => 'far fa-flag',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            < ?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Uploads',
                'number' => '13,648',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            < ?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Bookmarks',
                'number' => '41,410',
                'icon' => 'far fa-bookmark',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ]
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            < ?php $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Likes',
                'number' => '41,410',
                'theme' => 'success',
                'icon' => 'far fa-thumbs-up',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ]
            ]) ?>
            < ?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $infoBox->id.'-ribbon',
                'text' => 'Ribbon',
            ]) ?>
            < ?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            < ?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Events',
                'number' => '41,410',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-calendar-alt',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ],
                'loadingStyle' => true
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            < ?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'New Orders',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            < ?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => '150',
                'text' => 'New Orders',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'success'
            ]) ?>
            < ?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $smallBox->id.'-ribbon',
                'text' => 'Ribbon',
                'theme' => 'warning',
                'size' => 'lg',
                'textSize' => 'lg'
            ]) ?>
            < ?php \hail812\adminlte\widgets\SmallBox::end() ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            < ?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '44',
                'text' => 'User Registrations',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-success',
                'loadingStyle' => true
            ]) ?>
        </div>
    </div>
</div> -->