<?php

namespace backend\models;

use Yii;
use yii\helpers\Json;

class DetermineQuestion extends Question
{
    public function rules()
    {
        return [
            [['stem', 'answer'], 'required', 'message'=>'不能为空'],
            [['stem', 'analysis', 'metas'], 'string'],
            [['score'], 'number'],
            [['categoryId', 'parentId', 'subCount', 'finishedTimes', 'passedTimes', 'userId', 'updatedTime', 'createdTime', 'copyId'], 'integer'],
            [['type', 'difficulty'], 'string', 'max' => 64],
            [['target'], 'string', 'max' => 255],
        ];
    }
}
