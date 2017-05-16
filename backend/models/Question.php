<?php

namespace backend\models;

use Yii;
use backend\models\Admin;
use common\components\Helper;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property string $type
 * @property string $stem
 * @property double $score
 * @property string $answer
 * @property string $analysis
 * @property string $metas
 * @property integer $categoryId
 * @property string $difficulty
 * @property string $target
 * @property integer $parentId
 * @property integer $subCount
 * @property integer $finishedTimes
 * @property integer $passedTimes
 * @property integer $userId
 * @property integer $updatedTime
 * @property integer $createdTime
 * @property integer $copyId
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stem', 'answer', 'analysis', 'metas'], 'string'],
            [['score'], 'number'],
            [['categoryId', 'parentId', 'subCount', 'finishedTimes', 'passedTimes', 'userId', 'updatedTime', 'createdTime', 'copyId'], 'integer'],
            [['type', 'difficulty'], 'string', 'max' => 64],
            [['target'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '题型',
            'stem' => '题干',
            'score' => '分数',
            'answer' => '参考答案',
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

    public static function stemTextFilter($stem, $length)
    {
        return Helper::truncate_utf8_string($stem, $length);
    }

    public function getFilterStem($length = 30)
    {
        $className = QuestionTypeFactory::getClass($this->type);
        return $className::stemTextFilter($this->stem, $length);
    }

    public function getUser()
    {
        return $this->hasOne(Admin::className(), ['id' => 'userId']);
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

            return true;
        } else {
            return false;
        }
    }
}
