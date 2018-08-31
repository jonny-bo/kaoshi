<?php

namespace backend\models;

use Yii;
use backend\models\TestpaperItem;
use backend\models\Question;

/**
 * This is the model class for table "testpaper".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $limitedTime
 * @property string $pattern
 * @property string $target
 * @property string $status
 * @property double $score
 * @property double $passedScore
 * @property integer $itemCount
 * @property integer $createdUserId
 * @property integer $createdTime
 * @property integer $updatedUserId
 * @property integer $updatedTime
 * @property string $metas
 * @property integer $copyId
 */
class Testpaper extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testpaper';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'name', 'limitedTime'], 'required', 'message'=>'不能为空'],
            [['description', 'metas'], 'string'],
            [['limitedTime', 'itemCount', 'createdUserId', 'createdTime', 'updatedUserId', 'updatedTime', 'copyId'], 'integer'],
            [['score', 'passedScore'], 'number'],
            [['name', 'pattern', 'target'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'description' => '考试说明',
            'limitedTime' => '限制时间',
            'pattern' => '试卷生成/显示模式',
            'target' => '试卷所属对象',
            'status' => '状态',
            'score' => '总分',
            'passedScore' => '及格线',
            'itemCount' => '题目数量',
            'createdUserId' => '创建者',
            'createdTime' => '创建时间',
            'updatedUserId' => '更新人',
            'updatedTime' => '更新时间',
            'metas' => '题型排序',
            'copyId' => '复制来源',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createdUserId']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->createdTime = $this->updatedTime = time();
            } else {
                $this->updatedTime = time();
            }
            $this->createdUserId = Yii::$app->user->id;

            return true;
        } else {
            return false;
        }
    }

    public function getStatus()
    {
        if ($this->status == 'draft') {
            return '草稿';
        } else if ($this->status == 'open') {
            return '已发布';
        } else if ($this->status == 'close') {
            return '已关闭';
        }

        return '未知';
    }

    public function getQuestionCount($type)
    {
        $count = Question::find()->andWhere(['type' => $type, 'parentId' => 0])->count();

        return $count;
    }

    public function getQuestions($type)
    {
        $questions = Question::find()->andWhere(['type' => $type, 'parentId' => 0])->all();

        return $questions;
    }

    public function getItems($type = '')
    {
        if ($type == '') {
            $items = TestpaperItem::find()->andWhere(['testId' => $this->id, 'parentId' => '0'])->all();
        } else {
            $items = TestpaperItem::find()->andWhere(['testId' => $this->id, 'questionType' => $type, 'parentId' => '0'])->all();
        }
        
        return $items;
    }

    public function getItemCount($type = '')
    {
        if ($type == '') {
            $count = TestpaperItem::find()->andWhere(['testId' => $this->id, 'parentId' => '0'])->count();
        } else {
            $count = TestpaperItem::find()->andWhere(['questionType' => $type, 'testId' => $this->id, 'parentId' => '0'])->count();
        }
        
        if (empty($count)) {
            return 0;
        }
        return $count;
    }

    public function getMissScore()
    {
        $item = TestpaperItem::find()->andWhere(['questionType' => 'choice', 'testId' => $this->id])->one();

        if (empty($item)) {
            return 0;
        }
        return $item->missScore;
    }
}
