<?php

namespace backend\models;

use Yii;
use yii\helpers\Json;

class ChoiceQuestion extends Question
{
    public $choice;
    public $answeres;

    public $values = array(
        1 => 'A',
        2 => 'B',
        3 => 'C',
        4 => 'D',
        5 => 'E',
        6 => 'F'
    );

    public function rules()
    {
        return [
            [['stem', 'choice', 'answeres', 'difficulty'], 'required', 'message'=>'不能为空'],
            [['stem', 'analysis', 'metas'], 'string'],
            [['score'], 'number'],
            [['categoryId', 'parentId', 'subCount', 'finishedTimes', 'passedTimes', 'userId', 'updatedTime', 'createdTime', 'copyId'], 'integer'],
            [['type', 'difficulty'], 'string', 'max' => 64],
            [['target'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '题型',
            'stem' => '题干',
            'score' => '分数',
            'answeres' => '正确答案',
            'analysis' => '解析',
            'metas' => '题目元信息',
            'categoryId' => '类别',
            'difficulty' => '难度',
            'target' => '从属于',
            'parentId' => '材料来源',
            'subCount' => '子题数量',
            'finishedTimes' => '完成次数',
            'passedTimes' => '成功次数',
            'userId' => '用户',
            'updatedTime' => '更新时间',
            'createdTime' => '创建时间',
            'copyId' => '拷贝来源',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->createdTime = $this->updatedTime = time();
            } else {
                $this->updatedTime = time();
            }
            $this->userId = Yii::$app->user->id;
            $this->answer = Json::encode(array_keys(array_filter($this->answeres)));
            $this->metas = Json::encode($this->choice);

            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        foreach (Json::decode($this->answer) as $answer) {
            $this->answeres[$answer] = 1;
        }
        $this->choice = Json::decode($this->metas);
        $this->answer = Json::decode($this->answer);
    }
}
