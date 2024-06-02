<?php
use yii\helpers\Url;
$instructor = frontend\models\Instructor::findOne(['UserID' => Yii::$app->user->identity->getId()]);

?>
<nav class="m-5 text-center position-fixed bg-dark" aria-label="Sidebar navigation">
    <ul class="">
    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#sidenav" aria-expanded="false" aria-controls="pendingAssignments"> 
    <?php
        if ($instructor !== null && $instructor->profileImage !== null) {
            echo '<img src="' . Yii::$app->request->baseUrl . '/profiles/' . $instructor->profileImage . '" class="card rounded-4" style="width: 50px;">';
        } else {
            echo 'Navigate';
        }
        ?>
    </a>


    <div class="card collapse" id="sidenav">
    <ul class="nav flex-column mt-3">
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#viewAssignments" aria-expanded="false" aria-controls="viewAssignments">View Assignments</a>
            <div class="collapse" id="viewAssignments">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="<?= Url::to(['/assignment/']) ?>">All Assignments</a>
                    </li>
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="<?= Url::to(['/assignment/create']) ?>">Create New Assignment</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submittedAssignments" aria-expanded="false" aria-controls="submittedAssignments"> Submitted Assignments</a>
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
            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#markAssignments" aria-expanded="false" aria-controls="markAssignments">Mark Assignments</a>
            <div class="collapse" id="markAssignments">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="<?= Url::to(['/submission/individual-not-marked']) ?>">Individual Assignments</a>
                    </li>
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="<?= Url::to(['/submission/group-not-marked']) ?>">Group Assignments</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#markedAssignments" aria-expanded="false" aria-controls="markedAssignments">Marked Assignments</a>
            <div class="collapse" id="markedAssignments">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="<?= Url::to(['/submission/individual-marked']) ?>">Individual Assignments</a>
                    </li>
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="<?= Url::to(['/submission/group-marked']) ?>">Group Assignments</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#studentGroups" aria-expanded="false" aria-controls="studentGroups"> <!--<span class="badge float-end">3</span> -->Student Groups</a>
            <div class="collapse" id="studentGroups">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item border-bottom border-primary">
                        <a class="nav-link" href="<?= Url::to(['/groups/create']) ?>">Create New Groups</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item border-bottom border-primary">
            <a class="nav-link" href="<?= Url::to(['/instructor/profile']) ?>">Profile</a>
        </li>
    </ul>
    </div>
    </ul>

    
</nav>

<style>
    .nav{
        align-items: start;
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
