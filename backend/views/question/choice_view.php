<?php

use yii\helpers\Html;
?>

<div class="testpaper-question-body">
    <div class="testpaper-question-stem-wrap clearfix">
        <div class="testpaper-question-seq-wrap">
            <div class="testpaper-question-seq"><?= isset($seq) ? $seq : ''  ?></div>
            <div class="testpaper-question-score">
                <?= Html::encode(isset($score) ? $score : $model->score) ?> 分
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
            <input type="radio" data-type="choice" name="<?= isset($seq) ? $seq : ''  ?>" value="1">A
        </label>
        <label class="radio-inline ">
            <input type="radio" data-type="choice" name="<?= isset($seq) ? $seq : ''  ?>" value="2">B
        </label>
        <label class="radio-inline ">
            <input type="radio" data-type="choice" name="<?= isset($seq) ? $seq : ''  ?>" value="3">C
        </label>
        <label class="radio-inline ">
            <input type="radio" data-type="choice" name="<?= isset($seq) ? $seq : ''  ?>" value="4">D
        </label>
    </div>
    <div class="testpaper-question-actions pull-right">
    </div>
</div>
<?php if (!isset($type)) : ?>
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
<?php endif; ?>