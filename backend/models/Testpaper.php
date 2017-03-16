<?php

namespace backend\models;

use Yii;

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
            'description' => '试卷说明',
            'limitedTime' => '限制时间',
            'pattern' => '试卷生成/显示模式',
            'target' => '试卷所属对象',
            'status' => '试卷状态',
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
}
