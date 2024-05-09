<?php

namespace frontend\models;

use yii\base\Model;

class GroupForm extends Model
{
    public $groups = [];

    public function rules()
    {
        return [
            ['groups', 'required'],
            ['groups', 'validateGroups'],
        ];
    }

    public function validateGroups($attribute, $params)
    {
        foreach ($this->$attribute as $group) {
            if (!isset($group['GroupNO']) || empty($group['GroupNO'])) {
                $this->addError($attribute, 'Group number is required for all groups.');
                return;
            }
            if (!isset($group['groupName']) || empty($group['groupName'])) {
                $this->addError($attribute, 'Group name is required for all groups.');
                return;
            }
            if (!isset($group['StudentIDs']) || empty($group['StudentIDs'])) {
                $this->addError($attribute, 'At least one student must be selected for each group.');
                return;
            }
        }
    }
}
