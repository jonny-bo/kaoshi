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
                <?= $model->getStem() ?>
            </div>
        </div>
    </div>
    <div class="testpaper-question-footer clearfix">
        <div class="testpaper-question-fill-inputs">
            <?php foreach ($model->answer as $key => $answer) : ?>
                <input class="form-control " type="text" data-type="fill" name="7" placeholder="填空(<?= $key+1 ?>)答案，请填在这里">
            <?php endforeach ?>    
        </div>
        <div class="testpaper-question-actions pull-right">
        </div>
    </div>
    <div class="testpaper-preview-answer clearfix mtl mbl">
        <div class="testpaper-question-result">
            <?php foreach ($model->answer as $key => $answer) : ?>
                填空(<?= $key+1 ?>)： 正确答案 
                <strong class="text-success">
                    <?= join(' 或 ', $answer) ?>
                </strong>
                </br>
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