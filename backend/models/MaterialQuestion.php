<?php

namespace backend\models;

use Yii;
use yii\helpers\Json;
use common\components\Helper;

class MaterialQuestion extends Question
{
    public function rules()
    {
        return [
            [['stem', 'difficulty'], 'required', 'message'=>'不能为空'],
            [['stem', 'analysis', 'metas'], 'string'],
            [['score'], 'number'],
            [['categoryId', 'parentId', 'subCount', 'finishedTimes', 'passedTimes', 'userId', 'updatedTime', 'createdTime', 'copyId'], 'integer'],
            [['type', 'difficulty'], 'string', 'max' => 64],
            [['target'], 'string', 'max' => 255],
        ];
    }

    public function findItems()
    {
        $items =  Question::find()->where(['parentId' => $this->id])->all();
        foreach ($items as $key => $item) {
            $className = QuestionTypeFactory::getClass($item->type);
            $items[$key] = $className::findOne($item->id);
        }

        return $items;
    }
}
