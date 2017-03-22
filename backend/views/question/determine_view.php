<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\assets\AppAsset;

AppAsset::register($this);
AppAsset::addCss($this, Yii::$app->request->baseUrl."/css/question.css");

/* @var $this yii\web\View */
/* @var $model backend\models\Question */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '题目', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testpaper-question testpaper-question-choice">
    <div class="testpaper-question-body">
        <div class="testpaper-question-stem-wrap clearfix">
            <div class="testpaper-question-seq-wrap">
                <div class="testpaper-question-seq"></div>
                <div class="testpaper-question-score">
                    <?= Html::encode($model->score) ?> 分
                </div>
            </div>
            <div class="testpaper-question-stem">
                <?= $model->stem ?>
            </div>
        </div>
    </div>
    <div class="testpaper-question-footer clearfix">
        <div class="testpaper-question-determine-inputs">                      
            <label class="radio-inline ">
                <input type="radio" data-type="determine" name="6" value="0">正确
            </label>
            <label class="radio-inline ">
                <input type="radio" data-type="determine" name="6" value="1">错误
            </label>
        </div>
        <div class="testpaper-question-actions pull-right">
        </div>
    </div>
    <div class="testpaper-preview-answer clearfix mtl mbl">
        <div class="testpaper-question-result">
            正确答案是 
                <strong class="text-success">
                    <?= $model->answer == 1 ? '正确' : '错误' ?>
                </strong>
        </div>
    </div>
    <div class="testpaper-question-analysis well">
        <?php if (!$model->analysis) : ?>
            无解析
        <?php endif ?>

        <?= $model->analysis ?>
    </div>
</div>