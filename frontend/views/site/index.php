<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'AMS | Home';
?>

<div class="container" id="home-container">

    <header id="main-header" class="mt-4">
        <h1 class="text-center animated-title">Welcome to the Assignment Management System (AMS)</h1>
        <p class="lead text-center">Simplify your workflow with an intuitive platform that empowers instructors to manage assignments efficiently and helps students stay on top of their coursework.</p>
    </header>

    <main id="main-content" class="container">

        <!-- Features Section -->
        <section id="features-section" class="row features py-5">
            <div id="feature-assignment" class="col-md-4 text-center feature-box">
                <i class="fas fa-book fa-3x mb-3 icon-feature"></i> <!-- FontAwesome icon for a book -->
                <h3>Effortless Assignment Creation</h3>
                <p>With our system, instructors can create assignments in just a few clicks. Whether managing large classes or complex coursework, our interface streamlines assignment creation. No more paperwork—just clear, easy-to-use tools that save time and effort.</p>
                <p>Assignments can be customized with deadlines, resources, and grading rubrics, providing a flexible yet structured approach to coursework management.</p>
            </div>
            <div id="feature-submission" class="col-md-4 text-center feature-box">
                <i class="fas fa-upload fa-3x mb-3 icon-feature"></i> <!-- FontAwesome icon for upload -->
                <h3>Organized Submission Tracking</h3>
                <p>Keep track of every student's submission effortlessly. The platform automatically records submissions, provides notifications for late submissions, and allows easy review. Get detailed insights on class performance.</p>
                <p>Ensure no submission is missed and grading is done efficiently with automated tools.</p>
            </div>
            <div id="feature-calendar" class="col-md-4 text-center feature-box">
                <i class="fas fa-calendar-alt fa-3x mb-3 icon-feature"></i> <!-- FontAwesome icon for calendar -->
                <h3>Seamless Calendar Integration</h3>
                <p>Never miss a deadline with calendar integration. Sync due dates with calendar apps, making it easier for both instructors and students to stay organized.</p>
                <p>Set reminders and deadlines, with students receiving automatic notifications for smooth workflow.</p>
            </div>
        </section>

        <hr class="my-5">

        <!-- Benefits Section -->
        <section id="benefits-section" class="row benefits py-5">
            <article id="benefits-instructors" class="col-md-6">
                <i class="fas fa-chalkboard-teacher fa-3x mb-3 icon-feature"></i> <!-- FontAwesome icon for instructor -->
                <h2>Benefits for Instructors</h2>
                <ul class="unstyled-list">
                    <li>Save time by automating assignment distribution and collection.</li>
                    <li>Track student submissions effortlessly with detailed class performance analytics.</li>
                    <li>Provide timely feedback with efficient grading tools.</li>
                    <li>Enhance communication with students through easy messaging tools.</li>
                </ul>
                <p>Whether you're managing a small class or hundreds of students, AMS scales with your needs, making it ideal for any teaching environment.</p>
            </article>
            <article id="benefits-students" class="col-md-6">
                <i class="fas fa-user-graduate fa-3x mb-3 icon-feature"></i> <!-- FontAwesome icon for students -->
                <h2>Benefits for Students</h2>
                <ul class="unstyled-list">
                    <li>Easily access and view upcoming assignments and deadlines.</li>
                    <li>Submit assignments electronically for secure and timely submissions.</li>
                    <li>Track progress and performance throughout the course.</li>
                    <li>Communicate easily with instructors and peers.</li>
                </ul>
                <p>AMS empowers students with the tools they need to succeed in their academic journey.</p>
            </article>
        </section>

        <hr class="my-5">

        <!-- Additional Resources and Security Section -->
        <section id="resources-security-section" class="row py-5">
            <article id="additional-resources" class="col-md-6">
                <i class="fas fa-info-circle fa-3x mb-3 icon-feature"></i> <!-- FontAwesome icon for info -->
                <h2>Additional Resources</h2>
                <p>Our Help Center provides guides, FAQs, video tutorials, and detailed documentation. We offer a 24/7 support team to assist with questions or technical issues.</p>
                <p>Whether new to AMS or exploring advanced features, our resources support you every step of the way.</p>
            </article>
            <article id="security-privacy" class="col-md-6">
                <i class="fas fa-shield-alt fa-3x mb-3 icon-feature"></i> <!-- FontAwesome icon for security -->
                <h2>Security and Privacy</h2>
                <p>We prioritize your data security and privacy. AMS uses encryption, secure storage, and role-based access controls to protect your data.</p>
                <p>Feel confident knowing your sensitive information is secure, with robust documentation on our privacy and security measures.</p>
            </article>
        </section>

    </main>

</div>

<style>

    /* General Styling */
body {
    font-family: 'Arial', sans-serif;
    color: teal;
    background-color: #f7f7f7;
}

#home-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Header */
#main-header h1 {
    font-size: 2.5em;
    color: #007bff;
    animation: fadeInDown 1s ease-in-out;
}

#main-header p.lead {
    color: teal;
    margin-top: 15px;
}

/* Features Section */
/* #features-section {
    display: flex;
    justify-content: space-around;
}

.feature-box {
    padding: 20px;
    /* background-color: white; * /
    border-radius: 10px;
    /* box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); * /
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-box:hover {
    transform: translateY(-10px);
    /* box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.2); * /
} */

.icon-feature {
    color: #007bff;
    margin-bottom: 10px;
}

#features-section h3 {
    color: #007bff;
}

#features-section p,
#resources-security-section p,
#benefits-section p {
    color: teal;
}

/* Benefits Section */
#benefits-section h2 {
    font-size: 1.75em;
    color: #007bff;
}

.unstyled-list {
    list-style-type: none;
    padding-left: 0;
    color: teal;
}

.unstyled-list li {
    font-size: 1.1em;
    padding-left: 25px;
    position: relative;
    margin-bottom: 15px;
}

.unstyled-list li:before {
    content: "\f00c"; /* FontAwesome check icon */
    font-family: FontAwesome;
    position: absolute;
    left: 0;
    color: #28a745;
}

/* Additional Resources and Security Section */
#resources-security-section h2 {
    font-size: 1.75em;
    color: #007bff;
}

/* Animations */
@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Section Animations */
/* .feature-box, */
#benefits-section,
#features-section {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

/* .feature-box:hover, */
#benefits-section:hover,
#features-section:hover {
    opacity: 1;
    transform: translateY(0);
}

/* Global Styling Adjustments */
hr {
    border-top: 1px solid #ddd;
}

h2 {
    margin-top: 30px;
    color: #007bff;
}

/* p {
    color: #555;
} */

</style>