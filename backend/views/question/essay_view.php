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
        <div class="testpaper-question-essay-inputs">
            <input class="form-control " type="text" data-type="essay" name="7" placeholder="请填写答案"> 
        </div>
        <div class="testpaper-question-actions pull-right">
        </div>
    </div>
    <div class="testpaper-preview-answer clearfix mtl mbl">
        <div class="testpaper-question-result">
            参考答案：
            <?= $model->answer ?>
        </div>
    </div>
    <div class="testpaper-question-analysis well">
        <?php if (!$model->analysis) : ?>
            无解析
        <?php endif ?>

        <?= $model->analysis ?>
    </div>
</div>