<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Assignment".
 *
 * @property int $AssignmentID
 * @property string $courseCode
 * @property string $assignment
 * @property string $title
 * @property string|null $content
 * @property string|null $description
 * @property string|null $fileURL
 * @property string|null $assignedDate
 * @property string|null $submissionDate
 * @property int $marks
 * @property string|null $status
 *
 * @property Course $courseCode0
 * @property Submission[] $submissions
 */
class Assignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['courseCode', 'assignment', 'title', 'marks'], 'required'],
            [['assignment', 'content', 'description', 'status'], 'string'],
            [['assignedDate', 'submissionDate'], 'safe'],
            [['marks'], 'integer'],
            [['courseCode'], 'string', 'max' => 12],
            [['title', 'fileURL'], 'string', 'max' => 255],
            [['courseCode'], 'exist', 'skipOnError' => true, 'targetClass' => Course::class, 'targetAttribute' => ['courseCode' => 'courseCode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AssignmentID' => Yii::t('app', 'Assignment ID'),
            'courseCode' => Yii::t('app', 'Course Code'),
            'assignment' => Yii::t('app', 'Assignment'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'description' => Yii::t('app', 'Description'),
            'fileURL' => Yii::t('app', 'File Url'),
            'assignedDate' => Yii::t('app', 'Assigned Date'),
            'submissionDate' => Yii::t('app', 'Submission Date'),
            'marks' => Yii::t('app', 'Marks'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[CourseCode0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseCode0()
    {
        return $this->hasOne(Course::class, ['courseCode' => 'courseCode'])->inverseOf('assignments');
    }

    /**
     * Gets query for [[Submissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmissions()
    {
        return $this->hasMany(Submission::class, ['assignmentID' => 'AssignmentID'])->inverseOf('assignment');
    }
}
