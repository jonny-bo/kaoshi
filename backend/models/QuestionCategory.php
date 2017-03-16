<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "question_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $target
 * @property integer $userId
 * @property integer $updatedTime
 * @property integer $createdTime
 * @property integer $seq
 */
class QuestionCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['userId', 'updatedTime', 'createdTime', 'seq'], 'integer'],
            [['name', 'target'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'target' => 'Target',
            'userId' => 'User ID',
            'updatedTime' => 'Updated Time',
            'createdTime' => 'Created Time',
            'seq' => 'Seq',
        ];
    }
}
