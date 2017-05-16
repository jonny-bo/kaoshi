<?php

namespace backend\models;

use Yii;
use backend\models\Question;

/**
 * This is the model class for table "testpaper_item".
 *
 * @property integer $id
 * @property integer $testId
 * @property integer $seq
 * @property integer $questionId
 * @property string $questionType
 * @property integer $parentId
 * @property double $score
 * @property double $missScore
 */
class TestpaperItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testpaper_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['testId', 'seq', 'questionId', 'parentId'], 'integer'],
            [['score', 'missScore'], 'number'],
            [['questionType'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'testId' => 'Test ID',
            'seq' => 'Seq',
            'questionId' => 'Question ID',
            'questionType' => 'Question Type',
            'parentId' => 'Parent ID',
            'score' => 'Score',
            'missScore' => 'Miss Score',
        ];
    }

    public function getQuestion()
    {
        $className = QuestionTypeFactory::getClass($this->questionType);
        return $this->hasOne($className, ['id' => 'questionId']);
    }

    public function getAnwser($userId)
    {
        $answer = TestpaperItemResult::find()->where(['userId' => $userId, 'testId' => $this->testId, 'itemId' => $this->seq])->one();

        return json_decode($answer->answer, true);
    }
}
