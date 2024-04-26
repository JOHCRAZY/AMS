<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Programme".
 *
 * @property string $programmeCode
 * @property string $programmeName
 *
 * @property Course[] $courses
 * @property Student[] $students
 */
class Programme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Programme';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['programmeCode', 'programmeName'], 'required'],
            [['programmeCode'], 'string', 'max' => 5],
            [['programmeName'], 'string', 'max' => 255],
            [['programmeCode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'programmeCode' => Yii::t('app', 'Programme Code'),
            'programmeName' => Yii::t('app', 'Programme Name'),
        ];
    }

    /**
     * Gets query for [[Courses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::class, ['programmeCode' => 'programmeCode'])->inverseOf('programmeCode0');
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['programmeCode' => 'programmeCode'])->inverseOf('programmeCode0');
    }
    
}
