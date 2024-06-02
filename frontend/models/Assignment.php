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
 * @property string|null $AssignmentContent
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
    public $file;
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
            ['AssignmentID', 'default', 'value' => time()],
            [['courseCode', 'assignment', 'title', 'marks','description'], 'required'],
            [['assignment', 'AssignmentContent', 'description', 'status'], 'string'],
            [['assignedDate', 'submissionDate'], 'safe'],
            [['marks'], 'integer'],
            [['fileURL'], 'file', 'skipOnEmpty' => true,],
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
            'courseCode' => Yii::t('app', 'Module Code'),
            'assignment' => Yii::t('app', 'Assignment Type'),
            'title' => Yii::t('app', 'Assignment Title'),
            'AssignmentContent' => Yii::t('app', 'Edit Your Assignment'),
            'description' => Yii::t('app', 'Assignment'),
            'fileURL' => Yii::t('app', 'Attachment file'),
            'file' => Yii::t('app','Attach file'),
            'assignedDate' => Yii::t('app', 'Assigned Date'),
            'submissionDate' => Yii::t('app', 'Deadline'),
            'marks' => Yii::t('app', 'Total Marks'),
            'status' => Yii::t('app', 'Assignment Status'),
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
     *  Define the __toString method to represent the model as a string
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->assignment; // Assuming "name" is a property of your Assignment model
    }
    /**
     * Gets query for [[Submissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmissions()
    {
        return $this->hasMany(Submission::class, ['AssignmentID' => 'AssignmentID'])->inverseOf('assignment');
    }

    // public function upload()
    // {
    //     if ($this->validate()) {
    //         $uploadDir = 'attachments/';
    //         $filePath = $uploadDir . $this->file->baseName . '.' . $this->file->extension;
    //         if ($this->file->saveAs($filePath)) {
    //             $this->fileURL = $filePath;
    //             return true;
    //         }
    //     }
    //     return false;
    // }

   
}
