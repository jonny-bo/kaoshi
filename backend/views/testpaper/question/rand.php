<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

<div class="form-group">
    <label class="control-label">题目设置</label>
    <div class="testpaper-question-option-item">
            <button type="button" class="btn btn-link testpaper-question-option-item-sort-handler">
                <span class="glyphicon glyphicon-move"></span>
            </button>
            <span style="min-width:85px;display:inline-block;_display:inline;">选择题</span>
            <span class="mlm">题目数量:</span>
            <input type="text" class="form-control width-input width-input-mini input-sm item-number" name="counts[choice]" value="<?= Html::encode($model->getItemCount('choice')) ?>">/
            <span class="text-info question-num" role="questionNum" type="choice"><?= Html::encode($model->getQuestionCount('choice')) ?></span>

            <span class="mlm">题目分值:</span>
            <input type="text" class="form-control width-input width-input-mini input-sm item-score" name="scores[choice]" value="2">
            <span class="mlm">漏选分值:</span>
            <input type="text" class="form-control width-input width-input-mini input-sm item-score" name="scores[missScores]" value="<?= Html::encode($model->getMissScore()) ?>">
    </div>
    <div class="testpaper-question-option-item">
            <button type="button" class="btn btn-link testpaper-question-option-item-sort-handler">
                <span class="glyphicon glyphicon-move"></span>
            </button>
            <span style="min-width:85px;display:inline-block;_display:inline;">填空题</span>
            <span class="mlm">题目数量:</span>
            <input type="text" class="form-control width-input width-input-mini input-sm item-number" name="counts[fill]" value="<?= Html::encode($model->getItemCount('fill')) ?>">/
            <span class="text-info question-num" role="questionNum" type="fill"><?= Html::encode($model->getQuestionCount('fill')) ?></span>

            <span class="mlm">题目分值:</span>
            <input type="text" class="form-control width-input width-input-mini input-sm item-score" name="scores[fill]" value="2">
    </div>
    <div class="testpaper-question-option-item">
            <button type="button" class="btn btn-link testpaper-question-option-item-sort-handler">
                <span class="glyphicon glyphicon-move"></span>
            </button>
            <span style="min-width:85px;display:inline-block;_display:inline;">判断题</span>
            <span class="mlm">题目数量:</span>
            <input type="text" class="form-control width-input width-input-mini input-sm item-number" name="counts[determine]" value="<?= Html::encode($model->getItemCount('determine')) ?>">/
            <span class="text-info question-num" role="questionNum" type="determine"><?= Html::encode($model->getQuestionCount('determine')) ?></span>

            <span class="mlm">题目分值:</span>
            <input type="text" class="form-control width-input width-input-mini input-sm item-score" name="scores[determine]" value="2">
    </div>
    <div class="testpaper-question-option-item">
            <button type="button" class="btn btn-link testpaper-question-option-item-sort-handler">
                <span class="glyphicon glyphicon-move"></span>
            </button>
            <span style="min-width:85px;display:inline-block;_display:inline;">问答题</span>
            <span class="mlm">题目数量:</span>
            <input type="text" class="form-control width-input width-input-mini input-sm item-number" name="counts[essay]" value="<?= Html::encode($model->getItemCount('essay')) ?>">/
            <span class="text-info question-num" role="questionNum" type="essay"><?= Html::encode($model->getQuestionCount('essay')) ?></span>

            <span class="mlm">题目分值:</span>
            <input type="text" class="form-control width-input width-input-mini input-sm item-score" name="scores[essay]" value="2">
    </div>
    <div class="testpaper-question-option-item">
            <button type="button" class="btn btn-link testpaper-question-option-item-sort-handler">
                <span class="glyphicon glyphicon-move"></span>
            </button>
            <span style="min-width:85px;display:inline-block;_display:inline;">材料题</span>
            <span class="mlm">题目数量:</span>
            <input type="text" class="form-control width-input width-input-mini input-sm item-number" name="counts[material]" value="<?= Html::encode($model->getItemCount('material')) ?>">/
            <span class="text-info question-num" role="questionNum" type="material"><?= Html::encode($model->getQuestionCount('material')) ?></span>

            <span class="mlm">题目分值:</span>
            <input type="text" class="form-control width-input width-input-mini input-sm item-score" name="scores[material]" value="2">
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? '随机' : '随机', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'question-btn']) ?>
</div>

<?php ActiveForm::end(); ?>