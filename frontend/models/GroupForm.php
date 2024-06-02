<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class GroupForm extends Model
{
    public $StudentIDs = [];
    public $groupNO;
    public $groupName;

    public function rules()
    {
        return [
            [['StudentIDs', 'groupNO','groupName'], 'required'],
            [['groupNO'],'integer'],
            ['groupName','string'],
            ['StudentIDs', 'validateStudents'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'StudentIDs' => Yii::t('app', 'Students With No Groups'),
            'groupNO' => Yii::t('app', 'Group Number'),
            'groupName' => Yii::t('app', 'Group Name'),
        ];
    }

    public function validateStudents($attribute, $params)
    {
        if (!is_array($this->$attribute) || count($this->$attribute) < 2 ) {
            $this->addError($attribute, 'A Group Must have  At Least Two Students.');
            return;
        }

    }
}
