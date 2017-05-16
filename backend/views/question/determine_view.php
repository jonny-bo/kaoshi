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
</div>
<div class="testpaper-question-footer clearfix">
    <div class="testpaper-question-determine-inputs">                      
        <label class="radio-inline ">
            <input type="radio" data-type="determine" name="<?= isset($seq) ? $seq : ''  ?>" value="0">正确
        </label>
        <label class="radio-inline ">
            <input type="radio" data-type="determine" name="<?= isset($seq) ? $seq : ''  ?>" value="1">错误
        </label>
    </div>
    <div class="testpaper-question-actions pull-right">
    </div>
</div>
<?php if (!isset($type)) : ?>
<div class="testpaper-preview-answer clearfix mtl mbl <?= isset($type) ? 'hidden' : ''  ?>">
    <div class="testpaper-question-result">
        正确答案是 
            <strong class="text-success">
                <?= $model->answer == 1 ? '正确' : '错误' ?>
            </strong>
    </div>
</div>
<div class="testpaper-question-analysis well <?= isset($type) ? 'hidden' : ''  ?>">
    <?php if (!$model->analysis) : ?>
        无解析
    <?php endif ?>

    <?= $model->analysis ?>
</div>
<?php endif; ?>