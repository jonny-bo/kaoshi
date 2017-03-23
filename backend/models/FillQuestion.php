<?php

namespace backend\models;

use Yii;
use yii\helpers\Json;
use common\components\Helper;

class FillQuestion extends Question
{
    public $answeres;

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

    public function filter()
    {
        preg_match_all("/\[\[(.+?)\]\]/", $this->stem, $answer, PREG_PATTERN_ORDER);
        if (empty($answer[1])) {
            throw yii\web\ServerErrorHttpException("该问题没有答案或答案格式不正确！");
        }

        foreach ($answer[1] as $key => $value) {
            $value = explode('|', $value);
            foreach ($value as $i => $v) {
                $value[$i] = trim($v);
            }
            $this->answeres[$key] = $value;
        }
    }

    public static function stemTextFilter($stem, $length)
    {
        $stem =  preg_replace('/\[\[.+?\]\]/', '____', $stem);
        return Helper::truncate_utf8_string($stem, $length);
    }

    public function getStem()
    {
        return preg_replace('/\[\[.+?\]\]/', '____', $this->stem);
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
            $this->filter();
            $this->answer = Json::encode($this->answeres);
            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        $this->answer = Json::decode($this->answer);
    }
}
