<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Student".
 *
 * @property int $StudentID
 * @property string $fname
 * @property string|null $mname
 * @property string $lname
 * @property int|null $userID
 * @property string|null $session
 * @property string|null $regNo
 * @property string|null $phoneNumber
 * @property string|null $emailAddress
 * @property string|null $gender
 * @property string|null $profileImage
 * @property int|null $groupNo
 * @property string $programmeCode
 * @property string $year
 * @property string $semester
 *
 * @property Programme $programmeCode0
 * @property Submission[] $submissions
 * @property User $user
 */
class Student extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'programmeCode','regNo','session','gender', 'year', 'semester'], 'required'],
            [['userID'], 'integer'],
            [['session', 'gender', 'year', 'semester'], 'string'],
            [['fname', 'mname', 'lname'], 'string', 'max' => 25],
            [['regNo'], 'string', 'max' => 20],
            [['phoneNumber'], 'string', 'max' => 16],
            [['emailAddress'], 'string', 'max' => 64],
           // [['profileImage'], 'string', 'max' => 255],
           [['profileImage'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png','jpg','ico']],
            [['programmeCode'], 'string', 'max' => 5],
            [['regNo'], 'unique'],
            [['emailAddress'], 'unique'],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userID' => 'UserID']],
            [['programmeCode'], 'exist', 'skipOnError' => true, 'targetClass' => Programme::class, 'targetAttribute' => ['programmeCode' => 'programmeCode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'StudentID' => Yii::t('app', 'Student ID'),
            'fname' => Yii::t('app', 'First Name'),
            'mname' => Yii::t('app', 'Middle Name'),
            'lname' => Yii::t('app', 'Last Name'),
            'userID' => Yii::t('app', 'User ID'),
            'session' => Yii::t('app', 'Session'),
            'regNo' => Yii::t('app', 'Registration Number'),
            'phoneNumber' => Yii::t('app', 'Phone Number'),
            'emailAddress' => Yii::t('app', 'Email Address'),
            'gender' => Yii::t('app', 'Gender'),
            'profileImage' => Yii::t('app', 'Profile Image'),
            'programmeCode' => Yii::t('app', 'Programme'),
            'year' => Yii::t('app', 'Year'),
            'semester' => Yii::t('app', 'Semester'),
        ];
    }


    /**
     * Gets query for [[ProgrammeCode0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgrammeCode0()
    {
        return $this->hasOne(Programme::class, ['programmeCode' => 'programmeCode'])->inverseOf('students');
    }

    /**
     * Gets query for [[Submissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmissions()
    {
        return $this->hasMany(Submission::class, ['StudentID' => 'StudentID'])->inverseOf('student');
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['UserID' => 'userID'])->inverseOf('students');
    }

    public function upload()
    {
        if ($this->validate()) {
            $uploadDir = 'uploads/';
            $filePath = $uploadDir . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            if ($this->imageFile->saveAs($filePath)) {
                $this->profileImage = $filePath;
                return true;
            }
        }
        return false;
    }
}
