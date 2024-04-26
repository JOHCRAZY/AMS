<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Group".
 *
 * @property int $groupID
 * @property int $groupNo
 * @property string $courseCode
 * @property string|null $groupName
 *
 * @property Course $courseCode0
 * @property Student[] $students
 * @property Student $student
 * @property Submission[] $submissions
 */
class Group extends \yii\db\ActiveRecord
{
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
            [['groupNo', 'courseCode'], 'required'],
            [['groupNo'], 'integer'],
            [['courseCode'], 'string', 'max' => 12],
            [['groupName'], 'string', 'max' => 64],
            [['courseCode'], 'exist', 'skipOnError' => true, 'targetClass' => Course::class, 'targetAttribute' => ['courseCode' => 'courseCode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'groupID' => Yii::t('app', 'Group ID'),
            'groupNo' => Yii::t('app', 'Group No'),
            'courseCode' => Yii::t('app', 'Course Code'),
            'groupName' => Yii::t('app', 'Group Name'),
        ];
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
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['groupID' => 'groupID'])->inverseOf('group');
    }

    /**
     * Gets query for [[Submissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmissions()
    {
        return $this->hasMany(Submission::class, ['groupID' => 'groupID'])->inverseOf('group');
    }
}
