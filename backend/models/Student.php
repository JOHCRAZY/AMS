<?php

namespace backend\models;

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
 * @property int|null $groupID
 * @property string $programmeCode
 * @property string $year
 * @property string $semester
 *
 * @property Group $group
 * @property Programme $programmeCode0
 * @property User $user
 */
class Student extends \yii\db\ActiveRecord
{
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
            [['fname', 'lname', 'programmeCode', 'year', 'semester'], 'required'],
            [['userID', 'groupID'], 'integer'],
            [['session', 'gender', 'year', 'semester'], 'string'],
            [['fname', 'mname', 'lname'], 'string', 'max' => 25],
            [['regNo'], 'string', 'max' => 15],
            [['phoneNumber'], 'string', 'max' => 16],
            [['emailAddress'], 'string', 'max' => 64],
            [['profileImage'], 'string', 'max' => 255],
            [['programmeCode'], 'string', 'max' => 5],
            [['regNo'], 'unique'],
            [['emailAddress'], 'unique'],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userID' => 'UserID']],
            [['groupID'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['groupID' => 'groupID']],
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
            'fname' => Yii::t('app', 'Fname'),
            'mname' => Yii::t('app', 'Mname'),
            'lname' => Yii::t('app', 'Lname'),
            'userID' => Yii::t('app', 'User ID'),
            'session' => Yii::t('app', 'Session'),
            'regNo' => Yii::t('app', 'Reg No'),
            'phoneNumber' => Yii::t('app', 'Phone Number'),
            'emailAddress' => Yii::t('app', 'Email Address'),
            'gender' => Yii::t('app', 'Gender'),
            'profileImage' => Yii::t('app', 'Profile Image'),
            'groupID' => Yii::t('app', 'Group ID'),
            'programmeCode' => Yii::t('app', 'Programme Code'),
            'year' => Yii::t('app', 'Year'),
            'semester' => Yii::t('app', 'Semester'),
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['groupID' => 'groupID'])->inverseOf('students');
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['UserID' => 'userID'])->inverseOf('students');
    }
}
