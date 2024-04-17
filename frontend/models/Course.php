<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Course".
 *
 * @property string $courseCode
 * @property string|null $courseName
 * @property int|null $InstructorID
 * @property string|null $programmeCode
 *
 * @property Assignment[] $assignments
 * @property Group[] $groups
 * @property Instructor $instructor
 * @property Programme $programmeCode0
 * @property Student[] $students
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['courseCode'], 'required'],
            [['InstructorID'], 'integer'],
            [['courseCode'], 'string', 'max' => 12],
            [['courseName'], 'string', 'max' => 255],
            [['programmeCode'], 'string', 'max' => 5],
            [['courseCode'], 'unique'],
            [['InstructorID'], 'exist', 'skipOnError' => true, 'targetClass' => Instructor::class, 'targetAttribute' => ['InstructorID' => 'InstructorID']],
            [['programmeCode'], 'exist', 'skipOnError' => true, 'targetClass' => Programme::class, 'targetAttribute' => ['programmeCode' => 'programmeCode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'courseCode' => Yii::t('app', 'Course Code'),
            'courseName' => Yii::t('app', 'Course Name'),
            'InstructorID' => Yii::t('app', 'Instructor ID'),
            'programmeCode' => Yii::t('app', 'Programme Code'),
        ];
    }

    /**
     * Gets query for [[Assignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignments()
    {
        return $this->hasMany(Assignment::class, ['courseCode' => 'courseCode'])->inverseOf('courseCode0');
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::class, ['courseCode' => 'courseCode'])->inverseOf('courseCode0');
    }

    /**
     * Gets query for [[Instructor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstructor()
    {
        return $this->hasOne(Instructor::class, ['InstructorID' => 'InstructorID'])->inverseOf('courses');
    }

    /**
     * Gets query for [[ProgrammeCode0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgrammeCode0()
    {
        return $this->hasOne(Programme::class, ['programmeCode' => 'programmeCode'])->inverseOf('courses');
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['courseCode' => 'courseCode'])->inverseOf('courseCode0');
    }
}
