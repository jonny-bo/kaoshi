<?php

use yii\helpers\Html;
?>
<div class="material">
    <div class="well testpaper-question-stem-material">
        <?= $model->stem ?>
    </div>    
</div>

<?php foreach ($model->findItems() as $item) : ?>
    <div class="testpaper-question testpaper-question-choice">
        <?= $this->render($item->type.'_view', [
            'model' => $item
        ]) ?>    
    </div>
<?php endforeach ?>
