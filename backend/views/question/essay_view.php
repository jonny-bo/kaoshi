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
    <div class="testpaper-question-essay-inputs">
        <input class="form-control " type="text" data-type="essay" name="7" placeholder="请填写答案"> 
    </div>
    <div class="testpaper-question-actions pull-right">
    </div>
</div>
<div class="testpaper-preview-answer clearfix mtl mbl <?= isset($type) ? 'hidden' : ''  ?>">
    <div class="testpaper-question-result">
        参考答案：
        <?= $model->answer ?>
    </div>
</div>
<div class="testpaper-question-analysis well<?= isset($type) ? 'hidden' : ''  ?>">
    <?php if (!$model->analysis) : ?>
        无解析
    <?php endif ?>

    <?= $model->analysis ?>
</div>