
<?php if (!Yii::$app->user->isGuest): ?>
        <?php
$user = \frontend\models\User::findByUsername(Yii::$app->user->identity->username);
if ($user !== null) {
    if ($user->role == 'student') {
        $student = \frontend\models\Student::find()->where(['UserID' => $user->UserID])->one();

        if ($student != null) {
            echo '<div>'.$this->render('StudentSideNav',['assetDir' => $assetDir]).'</div>';
        } else {

            echo '<div class="col-sm-1 order-0 p-4 position-sticky fixed"><div class="card m-3 text-bg-warning-subtle p-3 text-center position-fixed">';
            echo '<span class="w-100">You\'re Not Yet Registered</span><br>';
            echo '<span class="w-100">Please fill Your Details to continue</span>';
            echo '<br>';
            echo '<a href="' . Yii::$app->urlManager->createUrl(['student/profile']) . '">Register</a>';
            echo '</div></div>';

        }

    } elseif ($user->role == 'instructor' /* && Yii::$app->controller->action->id !== 'error'*/) {
        $instructor = \frontend\models\Instructor::find()->where(['UserID' => $user->UserID])->one();
        if ($instructor !== null && $instructor->Status == 'Verified') {
            echo '<div>'.$this->render('InstructorSideNav').'</div>';
        } else {


            echo '<div class="col-sm-1 order-0 p-4 position-sticky fixed"><div class="card m-3 text-bg-warning-subtle p-2 text-center mt-5 position-fixed">';
            echo '<span class="w-100">You\'re Not Yet Verified</span><br>';
            echo '<span class="w-100">Please fill Your Details and Contact Administrator for Verification</span>';
            echo '<a href="' . Yii::$app->urlManager->createUrl(['instructor/profile']) . '">Fill Details</a>';
            echo '</div></div>';
        }
    }
}
?>
    <?php endif;?>