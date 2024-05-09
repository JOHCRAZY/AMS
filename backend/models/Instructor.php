<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Instructor".
 *
 * @property int $InstructorID
 * @property string $fname
 * @property string|null $mname
 * @property string $lname
 * @property int|null $UserID
 * @property string|null $mailAddress
 * @property string|null $phoneNumber
 * @property string|null $profileImage
 *
 * @property Course[] $courses
 * @property User $user
 */
class Instructor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Instructor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname', 'lname'], 'required'],
            [['UserID'], 'integer'],
            [['fname', 'mname', 'lname'], 'string', 'max' => 25],
            [['mailAddress'], 'string', 'max' => 64],
            [['phoneNumber'], 'string', 'max' => 16],
            [['profileImage'], 'string', 'max' => 255],
            [['UserID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['UserID' => 'UserID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'InstructorID' => Yii::t('app', 'Instructor ID'),
            'fname' => Yii::t('app', 'Fname'),
            'mname' => Yii::t('app', 'Mname'),
            'lname' => Yii::t('app', 'Lname'),
            'UserID' => Yii::t('app', 'User ID'),
            'mailAddress' => Yii::t('app', 'Mail Address'),
            'phoneNumber' => Yii::t('app', 'Phone Number'),
            'profileImage' => Yii::t('app', 'Profile Image'),
        ];
    }

    /**
     * Gets query for [[Courses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::class, ['InstructorID' => 'InstructorID'])->inverseOf('instructor');
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['UserID' => 'UserID'])->inverseOf('instructors');
    }
}
