<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Group".
 *
 * @property int $GroupID
 * @property int|null $GroupNO
 * @property string|null $groupName
 * @property int|null $StudentID
 * @property string|null $courseCode
 *
 * @property Course $courseCode0
 * @property Student $student
 * @property Submission[] $submissions
 */
class Group extends \yii\db\ActiveRecord
{
    
    public $StudentIDs = [];
    //public $groupNO;
    //public $groupName;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['GroupNO', 'StudentID'], 'integer'],
            [['groupName'], 'string', 'max' => 64],
            [['courseCode'], 'string', 'max' => 12],
            [['StudentIDs', 'groupNO','groupName'], 'required'],
            [['groupNO'],'integer'],
            ['groupName','string'],
            ['StudentIDs', 'validateStudents'],
            [['StudentID'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['StudentID' => 'StudentID']],
            [['courseCode'], 'exist', 'skipOnError' => true, 'targetClass' => Course::class, 'targetAttribute' => ['courseCode' => 'courseCode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'GroupID' => Yii::t('app', 'Group ID'),
            'GroupNO' => Yii::t('app', 'Group No'),
            'groupName' => Yii::t('app', 'Group Name'),
            'StudentID' => Yii::t('app', 'Student ID'),
            'courseCode' => Yii::t('app', 'Course Code'),
            'StudentIDs' => Yii::t('app', 'Students With No Groups'),
            'groupNO' => Yii::t('app', 'Group Number'),
        ];
    }


    public function validateStudents($attribute)
    {
        if (!is_array($this->$attribute) || count($this->$attribute) < 2 ) {
            $this->addError($attribute, 'A Group Must have  At Least Two Students.');
            return;
        }

    }
    /**
     * Gets query for [[CourseCode0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseCode0()
    {
        return $this->hasOne(Course::class, ['courseCode' => 'courseCode'])->inverseOf('groups');
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['StudentID' => 'StudentID'])->inverseOf('groups');
    }

    /**
     * Gets query for [[Submissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmissions()
    {
        return $this->hasMany(Submission::class, ['groupID' => 'GroupID'])->inverseOf('group');
    }
}
