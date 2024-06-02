<?php
use frontend\models\Student;
use yii\helpers\Url;
?>

<nav class="m-4 text-center position-fixed bg-dark p-1" aria-label="Sidebar navigation" style="max-height: 100%;">
    

<ul class="">
  <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#sidenav" aria-expanded="false" aria-controls="pendingAssignments"> 
        <?php
        $student = Student::findOne(['userID' => Yii::$app->user->identity->getId()]);
        if ($student !== null && $student->profileImage !== null) {
            echo '<img src="' . Yii::$app->request->baseUrl . '/profiles/' . $student->profileImage . '" class="card rounded-4" style="width: 50px;">';
        } else {
            echo 'Navigate';
        }
        ?>

  </a>
  <div class="card collapse elevation-5" id="sidenav">
    <ul class="nav flex-column  mt-3">
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="<?= Url::to(['/assignment/']) ?>">All Assignments</a>
        </li>
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#pendingAssignments" aria-expanded="false" aria-controls="pendingAssignments">Pending Assignments</a>
            <div class="collapse" id="pendingAssignments">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="<?= Url::to(['/assignment/individual']) ?>">Individual Assignment</a>
                    </li>
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="<?= Url::to(['/assignment/group']) ?>">Group Assignment</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submittedAssignments" aria-expanded="false" aria-controls="submittedAssignments">Submitted Assignments</a>
            <div class="collapse" id="submittedAssignments">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#individualSubmitted" aria-expanded="false" aria-controls="individualSubmitted">Individual Assignment</a>
                        <div class="collapse" id="individualSubmitted">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item border-bottom border-primary">
                                    <a class="nav-link" href="<?= Url::to(['/submission/individual-marked']) ?>">Marked</a>
                                </li>
                                <li class="nav-item border-bottom border-primary">
                                    <a class="nav-link" href="<?= Url::to(['/submission/individual-not-marked']) ?>">Not Marked</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#groupSubmitted" aria-expanded="false" aria-controls="groupSubmitted">Group Assignment</a>
                        <div class="collapse" id="groupSubmitted">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item border-bottom border-primary">
                                    <a class="nav-link" href="<?= Url::to(['/submission/group-marked']) ?>">Marked</a>
                                </li>
                                <li class="nav-item border-bottom border-primary">
                                    <a class="nav-link" href="<?= Url::to(['/submission/group-not-marked']) ?>">Not Marked</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="<?= Url::to(['groups/members']) ?>">Group Members</a>
        </li>
        <li class="nav-item border-bottom border-primary ">
            <a class="nav-link" href="<?= Url::to(['/student/profile']) ?>">Profile</a>
        </li>
    </ul>
    </div>
    </ul>
</nav>

<style>
  /* .nav-link {
    color: #000;
  } */
  .nav{
        align-items: start;
        justify-content: start;
    }
  .nav-link:hover {
    color: green;
  }
  .border-bottom {
    border-bottom: 1px solid;
  }
  .nav-item .collapse {
    background-color: black;
  }
</style>
