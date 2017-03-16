<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "testpaper_result".
 *
 * @property integer $id
 * @property string $paperName
 * @property integer $testId
 * @property integer $userId
 * @property double $score
 * @property double $objectiveScore
 * @property double $subjectiveScore
 * @property string $teacherSay
 * @property integer $rightItemCount
 * @property string $passedStatus
 * @property integer $limitedTime
 * @property integer $beginTime
 * @property integer $endTime
 * @property integer $updateTime
 * @property integer $active
 * @property string $status
 * @property string $target
 * @property integer $checkTeacherId
 * @property integer $checkedTime
 * @property integer $usedTime
 */
class TestpaperResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testpaper_result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['testId', 'userId', 'rightItemCount', 'limitedTime', 'beginTime', 'endTime', 'updateTime', 'active', 'checkTeacherId', 'checkedTime', 'usedTime'], 'integer'],
            [['score', 'objectiveScore', 'subjectiveScore'], 'number'],
            [['teacherSay', 'passedStatus', 'status'], 'string'],
            [['status'], 'required'],
            [['paperName', 'target'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'paperName' => 'Paper Name',
            'testId' => 'Test ID',
            'userId' => 'User ID',
            'score' => 'Score',
            'objectiveScore' => 'Objective Score',
            'subjectiveScore' => 'Subjective Score',
            'teacherSay' => 'Teacher Say',
            'rightItemCount' => 'Right Item Count',
            'passedStatus' => 'Passed Status',
            'limitedTime' => 'Limited Time',
            'beginTime' => 'Begin Time',
            'endTime' => 'End Time',
            'updateTime' => 'Update Time',
            'active' => 'Active',
            'status' => 'Status',
            'target' => 'Target',
            'checkTeacherId' => 'Check Teacher ID',
            'checkedTime' => 'Checked Time',
            'usedTime' => 'Used Time',
        ];
    }
}
