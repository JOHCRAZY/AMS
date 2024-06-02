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
 * @property string|null $emailAddress
 * @property string|null $phoneNumber
 * @property string|null $profileImage
 * @property string $Status 
 *
 * @property Course[] $courses
 * @property User $user
 */
class Instructor extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $Course;
    public $CourseInstructorID;
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
            ['InstructorID', 'default', 'value' => time()],
            [['fname', 'lname','Status','Course','CourseInstructorID'], 'required'],
            [['UserID'], 'integer'],
            [['fname', 'mname', 'lname'], 'string', 'max' => 25],
            [['emailAddress'], 'string', 'max' => 64],
            [['phoneNumber'], 'string', 'max' => 16],
            // [['profileImage'], 'string', 'max' => 255],
            [['profileImage'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png','jpg','ico']],
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
            'fname' => Yii::t('app', 'First Name'),
            'mname' => Yii::t('app', 'Middle Name'),
            'lname' => Yii::t('app', 'Last Name'),
            'UserID' => Yii::t('app', 'User ID'),
            'Course' => Yii::t('app','Instructor Course'),
            'emailAddress' => Yii::t('app', 'Email Address'),
            'phoneNumber' => Yii::t('app', 'Phone Number'),
            'imageFile' => Yii::t('app', 'Profile Image'),
            'CourseInstructorID' => Yii::t('app',''),
        ];
    }

    /**
     * Gets query for [[Courses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::class, ['courseInstructor' => 'InstructorID'])->inverseOf('courseInstructor0');
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


    public function upload()
    {

    if ($this->validate()) {

        if ($this->imageFile) {

            if ($this->profileImage) {
                unlink(Yii::getAlias('@webroot') . '/profiles/' . $this->profileImage);
            }

            $fileName = 'profile_' . time() . '.' . $this->imageFile->extension;

            $this->imageFile->saveAs(Yii::getAlias('@webroot/profiles/') . $fileName);

            $this->profileImage = $fileName;
        }
        return true;
     }

     return false;
}

}