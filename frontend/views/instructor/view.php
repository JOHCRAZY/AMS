<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Instructor $model */

$this->title = $model->fname . ' ' . $model->lname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instructors'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid mt-5 mb-4">
    <div class="card custom-card shadow-sm border-primary">
        <div class="card-body">
            <div class="row ">
                <div class="col-md-4 text-center">
                    <?php if ($model->profileImage): ?>
                        <img src="<?= Yii::$app->request->baseUrl . '/profiles/' . $model->profileImage ?>" class="img-fluid rounded-4" style="min-width: 200px;" alt="Profile Image">
                    <?php else: ?>
                        <div class="placeholder-image rounded-3 mb-3" style="width: 200px; height: 200px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                            <span class="text-muted">No Image</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <h2 class="mb-4 ml-5 text-center"><?= Html::encode($this->title) ?></h2>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <p class="card-text">
                                <i class="fas fa-user"></i>
                                <strong>First Name:</strong> <?= Html::encode($model->fname) ?>
                            </p>
                        </div>
                        <div class="col-6 mb-3">
                            <p class="card-text">
                                <i class="fas fa-user"></i>
                                <strong>Middle Name:</strong> <?= Html::encode($model->mname) ?>
                            </p>
                        </div>
                        <div class="col-6 mb-3">
                            <p class="card-text">
                                <i class="fas fa-user"></i>
                                <strong>Last Name:</strong> <?= Html::encode($model->lname) ?>
                            </p>
                        </div>
                        <div class="col-6 mb-3">
                            <p class="card-text">
                                <i class="fas fa-envelope"></i>
                                <strong>Email Address:</strong> <?= Html::encode($model->emailAddress) ?>
                            </p>
                        </div>
                        <div class="col-6 mb-3">
                            <p class="card-text">
                                <i class="fas fa-phone"></i>
                                <strong>Phone Number:</strong> <?= Html::encode($model->phoneNumber) ?>
                            </p>
                        </div>
                        <div class="col-6 mb-3">
                            <p class="card-text">
                                <i class="fas fa-book"></i>
                                <strong>Module Code:</strong>
                                <?= Html::encode($model->Status == 'Verified' ? frontend\models\Course::find()->where(['courseInstructor' => $model->InstructorID])->one()->courseCode : ' N/A ') ?>
                            </p>
                        </div>
                        <div class="col-6 mb-3">
                            <p class="card-text">
                                <i class="fas fa-book-open"></i>
                                <strong>Module Name:</strong>
                                <?= Html::encode($model->Status == 'Verified' ? frontend\models\Course::find()->where(['courseInstructor' => $model->InstructorID])->one()->courseName : ' N/A ') ?>
                            </p>
                        </div>
                        <div class="col-6 mb-3">
                            <p class="card-text">
                                <i class="fas fa-check"></i>
                                <strong>Verification Status:</strong> <?= $model->Status == 'Verified' ? '<span class="text-success">Verified by Admin</span>' : '<span class="text-danger">Pending :- Not Verified by Admin</span>'; ?>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <?= Html::a(Yii::t('app', 'Update'), ['update', 'InstructorID' => $model->InstructorID], ['class' => 'btn btn-outline-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.custom-card {
    border: 1px solid #ddd;
    border-radius: 15px;
    background: #fff;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}


.custom-card:hover {
    transform: translate(-1px,-3px);
    box-shadow: 10 24px 28px rgba(0, 0, 0, 0.2);
}

.card-body {
    padding: 10px;
}

.card-text {
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
    color: #6c757d;
}

.placeholder-image {
    border-radius: 10px;
    text-align: center;
    line-height: 200px;
}

.btn-outline-primary {
    font-size: 0.875rem;
}
</style>
