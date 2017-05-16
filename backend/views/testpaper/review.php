<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);
AppAsset::addCss($this, Yii::$app->request->baseUrl."/css/question.css");
$type = 'exam';

if (!isset($label)) {
    $label = '试卷批阅';
}
/* @var $this yii\web\View */
/* @var $model backend\models\Testpaper */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $label, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="es-section testpaper-heading">
    <div class="testpaper-titlebar clearfix">
        <h1 class="testpaper-title">
            <?=$this->title?><br>
          <small class="text-sm"></small>
        </h1>
        <div class="testpaper-status">
          <div class="label label-success"><?=$label?>中</div>
        </div>
    </div>
    <div class="testpaper-description"><p><?=$model->description?></p>
</div>
  <div class="testpaper-metas">
    共 <?=$model->getItemCount()  ?> 题，总分 <?=$model->score  ?> 分
      ，及格为 <?=$model->passedScore  ?> 分，请在 <?=$model->limitedTime  ?> 分钟内作答。
  </div>
    <div id="testpaper-navbar" class="testpaper-navbar affix-top" data-spy="affix" data-offset-top="200">
        <ul class="nav nav-pills clearfix">
            <li><a href="#testpaper-questions-single_choice">单选题</a></li>
            <li><a href="#testpaper-questions-fill">填空题</a></li>
            <li><a href="#testpaper-questions-determine">判断题</a></li>
            <li><a href="#testpaper-questions-essay">问答题</a></li>
            <li><a href="#testpaper-questions-material">材料题</a></li>
        </ul>
    </div>
</div>

<div class="row">
  <div class="col-md-9 prevent-copy">
    <div class="testpaper-body">
    <?php $form = ActiveForm::begin(['id' => 'userExamForm']); ?>
        <?php if ($model->getItems('choice')) : ?>
          <div class="panel panel-default testpaper-question-block" id="testpaper-questions-single_choice">
              <div class="panel-heading">
                  <strong class="">单选题</strong>
                  <small class="text-muted">共<?=$model->getItemCount('choice') ?>题</small>
              </div>
              <div class="panel-body">
                <?php foreach ($model->getItems('choice') as $item) : ?> 
                  <div class="testpaper-question testpaper-question-choice id="question6">
                    <?= $this->render("../question/choice_view.php", [
                        'model' => $item->question,
                        'seq'   => $item->seq,
                        'score' => $item->score,
                    ]) ?>
                  <div class="testpaper-preview-answer clearfix mtl mbl">
                      <div class="testpaper-question-result">
                          考生选择的答案是 
                            <strong class="text-success">
                                <?= Html::encode($item->question->values[$item->getAnwser($userId)]) ?>
                            </strong>
                      </div>
                      <br>
                      评分：　<input type="text" name="review[<?=$item->seq?>]" width="50px;">
                  </div>
                  </div>
                <?php endforeach; ?>
              </div>
          </div>
        <?php endif; ?>

        <?php if ($model->getItems('fill')) : ?>
          <div class="panel panel-default testpaper-question-block" id="testpaper-questions-fill">
              <div class="panel-heading">
                  <strong class="">填空题</strong>
                  <small class="text-muted">共<?=$model->getItemCount('fill') ?>题</small>
              </div>
              <div class="panel-body">
                <?php foreach ($model->getItems('fill') as $item) : ?> 
                  <div class="testpaper-question testpaper-question-fill id="question6">
                    <?= $this->render("../question/fill_view.php", [
                        'model' => $item->question,
                        'seq'   => $item->seq,
                        'score' => $item->score,
                    ]) ?>
                  </div>
                  <div class="testpaper-preview-answer clearfix mtl mbl">
                      <div class="testpaper-question-result">
                            <?php foreach ($item->question->answer as $key => $answer) : ?>
                                考生填的第<?=$key+1?>空答案： <?=$item->getAnwser($userId)[$key+1]?>
                            <?php endforeach ?> 
                      </div>
                      <br>
                    评分：　<input type="text" name="review[<?=$item->seq?>]" width="50px;">
                  </div>
                <?php endforeach; ?>
              </div>
          </div>
        <?php endif; ?>

        <?php if ($model->getItems('determine')) : ?>
          <div class="panel panel-default testpaper-question-block" id="testpaper-questions-determine">
              <div class="panel-heading">
                  <strong class="">判断题</strong>
                  <small class="text-muted">共<?=$model->getItemCount('determine') ?>题</small>
              </div>
              <div class="panel-body">
                <?php foreach ($model->getItems('determine') as $item) : ?> 
                  <div class="testpaper-question testpaper-question-determine id="question6">
                    <?= $this->render("../question/determine_view.php", [
                        'model' => $item->question,
                        'seq'   => $item->seq,
                        'score' => $item->score,
                    ]) ?>
                  </div>
                  <div class="testpaper-question-result">
                      考生选择的答案是 
                      <strong class="text">
                        <?= $item->getAnwser($userId) == 1 ? '正确' : '错误' ?>
                      </strong>
                  </div>
                  <br>
                    评分：　<input type="text" name="review[<?=$item->seq?>]" width="50px;">
                <?php endforeach; ?>
              </div>
          </div>
        <?php endif; ?>

        <?php if ($model->getItems('essay')) : ?>
          <div class="panel panel-default testpaper-question-block" id="testpaper-questions-essay">
              <div class="panel-heading">
                  <strong class="">问答题</strong>
                  <small class="text-muted">共<?=$model->getItemCount('essay') ?>题</small>
              </div>
              <div class="panel-body">
                <?php foreach ($model->getItems('essay') as $item) : ?> 
                  <div class="testpaper-question testpaper-question-essay id="question6">
                    <?= $this->render("../question/essay_view.php", [
                        'model' => $item->question,
                        'seq'   => $item->seq,
                        'score' => $item->score,
                    ]) ?>
                    <div class="testpaper-question-result">
                        考生的答案是:
                        <?= $item->getAnwser($userId) ?>
                    </div>
                    <br>
                    评分：　<input type="text" name="review[<?=$item->seq?>]" width="50px;">
                  </div>
                <?php endforeach; ?>
              </div>
          </div>
        <?php endif; ?>

        <?php if ($model->getItems('material')) : ?>
          <div class="panel panel-default testpaper-question-block" id="testpaper-questions-material">
              <div class="panel-heading">
                  <strong class="">材料题</strong>
                  <small class="text-muted">共<?=$model->getItemCount('material') ?>题</small>
              </div>
              <div class="panel-body">
                <?php foreach ($model->getItems('material') as $item) : ?> 
                  <div class="testpaper-question testpaper-question-material id="question6">
                    <div class="material">
                      <div class="well testpaper-question-stem-material">
                            <?= $item->question->stem ?>
                      </div>    
                    </div>

                    <?php foreach ($item->question->findItems() as $one) : ?>
                        <div class="testpaper-question testpaper-question-choice">
                            <?= $this->render("../question/{$one->type}_view", [
                                'model' => $one,
                                'seq'   => $item->seq++,
                                'score' => $item->score,
                            ]) ?>    
                        </div>
                    <?php endforeach ?>
                    评分：　<input type="text" name="review[<?=$item->seq?>]" width="50px;">
                  </div>
                <?php endforeach; ?>
              </div>
          </div>
        <?php endif; ?>
        <input type="hidden" name="beginTime" value="<?=isset($beginTime) ? $beginTime : '' ?>">
        <?php ActiveForm::end(); ?>
    </div>
  </div>
  <div class="col-md-3">
      <div class="testpaper-card affix-top" data-spy="affix" data-offset-top="200" data-offset-bottom="200">
        <div class="panel panel-default">
          <div class="panel-body">
            <?php for ($i = 1; $i <= $model->getItemCount(); $i++) : ?> 
              <a href="javascript:;" data-anchor="#question6" class="btn btn-default btn-index pull-left "><?=$i?></a>
            <?php endfor; ?>
            <div class="clearfix mtm mbm"></div> 
          </div>
          <div class="panel-footer">
              <button class="btn btn-success btn-block" type="submit" form="userExamForm">提交批阅</button>
          </div>
        </div>
      </div>
  </div>
</div>