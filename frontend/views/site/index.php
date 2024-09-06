<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/** @var yii\web\View $this */

$this->title = 'Assignment Management System';
?>

<div class="container">

    <header class="mt-4">
        <!-- <h1>< ?= Html::encode($this->title) ?></h1> -->
        <!-- <p class="lead">Streamline your assignments and boost academic success.</p> -->
        <!-- < ?php if(Yii::$app->user->isGuest): ?>
        <p>< ?= Html::a('Get Started', ['/site/login'], ['class' => 'btn btn-lg btn-primary']) ?></p>
        < ?php endif; ?> -->
    </header>

    <main class="container">

        <section class="row features">
            <div class="col-md-4">
                <!-- < ?= Html::icon('book') ?> -->
                <h3>Effortless Assignment Creation</h3>
                <p>Create, distribute, and manage assignments with ease. Our intuitive interface saves instructors valuable time.</p>
                <!-- < ?= Html::a('Learn more', ['/site/about'], ['class' => 'btn btn-outline-primary']) ?> -->
            </div>
            <div class="col-md-4">
                <!-- < ?= Html::icon('upload') ?> -->
                <h3>Organized Submission Tracking</h3>
                <p>Effortlessly track submissions and manage grading. Our system provides comprehensive features for monitoring student progress and delivering timely feedback.</p>
                <!-- < ?= Html::a('Explore features', ['/site/about'], ['class' => 'btn btn-outline-primary']) ?> -->
            </div>
            <div class="col-md-4">
                <!-- < ?= Html::icon('calendar-alt') ?> -->
                <h3>Seamless Calendar Integration</h3>
                <p>Stay on top of deadlines with calendar integration. Sync due dates with your preferred calendar to ensure everyone stays organized.</p>
                <!-- < ?= Html::a('Get started', ['/site/calendar'], ['class' => 'btn btn-outline-primary']) ?> -->
            </div>
        </section>

        <hr class="my-5">

        <section class="row benefits">
            <div class="col-md-6">
                <h2>Benefits for Instructors</h2>
                <ul>
                    <li>Save time creating and managing assignments</li>
                    <li>Effortlessly track submissions and student progress</li>
                    <li>Provide timely feedback with efficient grading tools</li>
                    <li>Enhance communication and collaboration with students</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2>Benefits for Students</h2>
                <ul>
                    <li>Stay organized with clear and visible assignment deadlines</li>
                    <li>Submit assignments electronically and receive feedback efficiently</li>
                    <li>Easily track their progress and performance throughout the course</li>
                    <li>Seamlessly communicate with instructors</li>
                </ul>
            </div>
        </section>

        <hr class="my-5">

        <section class="row">
            <div class="col-md-6">
                <h2>Additional Resources</h2>
                <p>Our comprehensive Help Center provides guides, FAQs, and support resources. Additionally, our dedicated support team is available 24/7 to assist you.</p>
                <?= Html::a('Visit Help Center', ['/site/contact'], ['class' => 'btn btn-secondary']) ?>
            </div>
            <div class="col-md-6">
                <h2>Security and Privacy</h2>
                <p>We take the security and privacy of your data extremely seriously. Learn more about our security measures and privacy policies here.</p>
                <!-- < ?= Html::a('Security & Privacy', ['/site/about'], ['class' => 'btn btn-secondary']) ?> -->
            </div>
        </section>

    </main>

</div>



<!-- < ?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Congratulations!</h1>
            <p class="fs-5 fw-light">You have successfully created your Yii-powered application.</p>
            <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div> -->
