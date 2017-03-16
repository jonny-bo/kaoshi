<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "question_marker".
 *
 * @property integer $id
 * @property integer $markerId
 * @property integer $questionId
 * @property integer $seq
 * @property string $type
 * @property string $stem
 * @property string $answer
 * @property string $analysis
 * @property string $metas
 * @property string $difficulty
 * @property integer $createdTime
 * @property integer $updatedTime
 */
class QuestionMarker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_marker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['markerId', 'questionId'], 'required'],
            [['markerId', 'questionId', 'seq', 'createdTime', 'updatedTime'], 'integer'],
            [['stem', 'answer', 'analysis', 'metas'], 'string'],
            [['type', 'difficulty'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'markerId' => 'Marker ID',
            'questionId' => 'Question ID',
            'seq' => 'Seq',
            'type' => 'Type',
            'stem' => 'Stem',
            'answer' => 'Answer',
            'analysis' => 'Analysis',
            'metas' => 'Metas',
            'difficulty' => 'Difficulty',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
        ];
    }
}
