<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "testpaper_item_result".
 *
 * @property integer $id
 * @property integer $itemId
 * @property integer $testId
 * @property integer $testPaperResultId
 * @property integer $userId
 * @property integer $questionId
 * @property string $status
 * @property double $score
 * @property string $answer
 * @property string $teacherSay
 * @property integer $pId
 */
class TestpaperItemResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testpaper_item_result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemId', 'testId', 'testPaperResultId', 'userId', 'questionId', 'pId'], 'integer'],
            [['status', 'answer', 'teacherSay'], 'string'],
            [['score'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemId' => 'Item ID',
            'testId' => 'Test ID',
            'testPaperResultId' => 'Test Paper Result ID',
            'userId' => 'User ID',
            'questionId' => 'Question ID',
            'status' => 'Status',
            'score' => 'Score',
            'answer' => 'Answer',
            'teacherSay' => 'Teacher Say',
            'pId' => 'P ID',
        ];
    }

    public function getQuestion()
    {
        $question = Question::findOne($this->questionId);
        $className = QuestionTypeFactory::getClass($$question->type);
        return $this->hasOne($className, ['id' => 'questionId']);
    }
}
