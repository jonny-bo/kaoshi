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
            <?= $model->getStem() ?>
        </div>
    </div>
</div>
<div class="testpaper-question-footer clearfix">
    <div class="testpaper-question-fill-inputs">
        <?php foreach ($model->answer as $key => $answer) : ?>
            <input class="form-control " type="text" data-type="fill" name="<?= isset($seq) ? $seq : ''  ?>[<?=$key+1?>]" placeholder="填空(<?= $key+1 ?>)答案，请填在这里">
        <?php endforeach ?>    
    </div>
    <div class="testpaper-question-actions pull-right">
    </div>
</div>
<?php if (!isset($type)) : ?>
<div class="testpaper-preview-answer clearfix mtl mbl <?= isset($type) ? 'hidden' : ''  ?>">
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
<div class="testpaper-question-analysis well <?= isset($type) ? 'hidden' : ''  ?>">
    <?php if (!$model->analysis) : ?>
        无解析
    <?php endif ?>

    <?= $model->analysis ?>
</div>
<?php endif; ?>