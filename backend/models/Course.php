<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Course".
 *
 * @property string $courseCode
 * @property string|null $courseName
 * @property string $semester
 * @property string $year
 * @property int|null $courseInstructor
 * @property string|null $programmeCode
 *
 * @property Assignment[] $assignments
 * @property Instructor $courseInstructor0
 * @property Group[] $groups
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
            [['courseCode', 'semester', 'year'], 'required'],
            [['semester', 'year'], 'string'],
            [['courseInstructor'], 'integer'],
            [['courseCode'], 'string', 'max' => 12],
            [['courseName'], 'string', 'max' => 255],
            [['programmeCode'], 'string', 'max' => 5],
            [['courseCode'], 'unique'],
            [['courseInstructor'], 'exist', 'skipOnError' => true, 'targetClass' => Instructor::class, 'targetAttribute' => ['courseInstructor' => 'InstructorID']],
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
            'semester' => Yii::t('app', 'Semester'),
            'year' => Yii::t('app', 'Year'),
            'courseInstructor' => Yii::t('app', 'Course Instructor'),
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
     * Gets query for [[CourseInstructor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseInstructor0()
    {
        return $this->hasOne(Instructor::class, ['InstructorID' => 'courseInstructor'])->inverseOf('courses');
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

