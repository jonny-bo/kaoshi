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
        <ul class="testpaper-question-choices">
            <li class="">
                <span class="testpaper-question-choice-index">A.</span> 
                <p><?= Html::encode($model->choice[0]) ?></p>
            </li>
            <li class="">
                <span class="testpaper-question-choice-index">B.</span> 
                <p><?= Html::encode($model->choice[1]) ?></p>
            </li>
            <li class="">
                <span class="testpaper-question-choice-index">C.</span> 
                <p><?= Html::encode($model->choice[2]) ?></p>
            </li>
            <li class="">
                <span class="testpaper-question-choice-index">D.</span> 
                <p><?= Html::encode($model->choice[3]) ?></p>
            </li>
        </ul>
    </div>
    <div class="testpaper-question-footer clearfix">
        <div class="testpaper-question-choice-inputs">                      
            <label class="radio-inline ">
                <input type="radio" data-type="choice" name="6" value="0">A
            </label>
            <label class="radio-inline ">
                <input type="radio" data-type="choice" name="6" value="1">B
            </label>
            <label class="radio-inline ">
                <input type="radio" data-type="choice" name="6" value="2">C
            </label>
            <label class="radio-inline ">
                <input type="radio" data-type="choice" name="6" value="3">D
            </label>
        </div>
        <div class="testpaper-question-actions pull-right">
        </div>
    </div>
    <div class="testpaper-preview-answer clearfix mtl mbl">
        <div class="testpaper-question-result">
            正确答案是 
            <?php foreach ($model->answer as $index) : ?>
                <strong class="text-success">
                    <?= Html::encode($model->values[$index]) ?>
                </strong>
            <?php endforeach ?>
        </div>
    </div>
    <div class="testpaper-question-analysis well">
        <?php if (!$model->analysis) : ?>
            无解析
        <?php endif ?>

        <?= $model->analysis ?>
    </div>
</div>