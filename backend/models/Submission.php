<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Submission".
 *
 * @property int $SubmissionID
 * @property int|null $AssignmentID
 * @property int|null $groupID
 * @property int|null $StudentID
 * @property string|null $content
 * @property string $submissionDate
 * @property string|null $fileURL
 * @property string $status
 * @property int|null $score
 *
 * @property Assignment $assignment
 * @property Group $group
 * @property User $student
 */
class Submission extends \yii\db\ActiveRecord
{
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
            [['AssignmentID', 'groupID', 'StudentID', 'score'], 'integer'],
            [['content', 'status'], 'string'],
            [['submissionDate', 'status'], 'required'],
            [['submissionDate'], 'safe'],
            [['fileURL'], 'string', 'max' => 255],
            [['AssignmentID'], 'exist', 'skipOnError' => true, 'targetClass' => Assignment::class, 'targetAttribute' => ['AssignmentID' => 'AssignmentID']],
            [['groupID'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['groupID' => 'groupID']],
            [['StudentID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['StudentID' => 'UserID']],
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
            'groupID' => Yii::t('app', 'Group ID'),
            'StudentID' => Yii::t('app', 'Student ID'),
            'content' => Yii::t('app', 'Content'),
            'submissionDate' => Yii::t('app', 'Submission Date'),
            'fileURL' => Yii::t('app', 'File Url'),
            'status' => Yii::t('app', 'Status'),
            'score' => Yii::t('app', 'Score'),
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
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['groupID' => 'groupID'])->inverseOf('submissions');
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::class, ['UserID' => 'StudentID'])->inverseOf('submissions');
    }
}
