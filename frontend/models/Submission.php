<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Submission".
 *
 * @property int $SubmissionID
 * @property int|null $AssignmentID
 * @property int|null $groupNO
 * @property int|null $StudentID
 * @property string|null $SubmissionContent
 * @property string|null $submissionDate
 * @property string|null $fileURL
 * @property int|null $score
 * @property string|null $AssignmentStatus
 * @property string|null $SubmissionStatus
 *
 * @property Assignment $assignment
 * @property Student $student
 */
class Submission extends \yii\db\ActiveRecord
{
    public $PreScore;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Submission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['SubmissionID', 'default', 'value' => time()],
            [['PreScore'], 'required'],
            [['AssignmentID', 'groupNO', 'StudentID', 'score'], 'integer'],
            [['SubmissionContent', 'AssignmentStatus', 'SubmissionStatus'], 'string'],
            [['submissionDate'], 'safe'],
            [['fileURL'], 'string', 'max' => 255],
            [['AssignmentID'], 'exist', 'skipOnError' => true, 'targetClass' => Assignment::class, 'targetAttribute' => ['AssignmentID' => 'AssignmentID']],
            // [['groupID'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['groupID' => 'groupID']],
            [['StudentID'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['StudentID' => 'StudentID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SubmissionID' => Yii::t('app', 'Submission ID'),
            'AssignmentID' => Yii::t('app', 'Assignment ID'),
            'groupNO' => Yii::t('app', 'Group Number'),
            'PreScore' => Yii::t('app','Student Score'),
            'StudentID' => Yii::t('app', 'Student ID'),
            'SubmissionContent' => Yii::t('app', 'Student Work'),
            'submissionDate' => Yii::t('app', 'Submission Date'),
            'fileURL' => Yii::t('app', 'File Url'),
            'score' => Yii::t('app', 'Score'),
            'AssignmentStatus' => Yii::t('app', 'Assignment Status'),
            'SubmissionStatus' => Yii::t('app', 'Submission Status'),
        ];
    }

    /**
     * Gets query for [[Assignment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignment()
    {
        return $this->hasOne(Assignment::class, ['AssignmentID' => 'AssignmentID'])->inverseOf('submissions');
    }

    

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['StudentID' => 'StudentID'])->inverseOf('submissions');
    }
}
