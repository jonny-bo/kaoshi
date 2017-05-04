<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\Helper;
use backend\models\FillQuestion;

?>
<?php $form = ActiveForm::begin(); ?>

<table class="table table-striped table-hover tab-content" id="testpaper-table">
  <thead>
    <tr>
      <th></th>
      <th><input type="checkbox" data-role="batch-select"></th>
      <th>题号</th>
      <th width="40%">题干</th>
      <th>类型</th>
      <th>难度</th>
      <th width="8%">分值</th>
      <th>操作</th>
    </tr>
  </thead>
    <tbody data-type="single_choice" id="testpaper-items-single_choice" class="testpaper-table-tbody">
        <?php foreach ($model->getItems() as $item) : ?>
        <tr id="testpaper-item-<?=$item->id?>" data-id="3" data-type="single_choice" class=" is-question">
          <td>
            <span class="glyphicon glyphicon-resize-vertical sort-handle"></span>  
          </td>
          <td>
            <input class="notMoveHandle" type="checkbox" value="3" data-role="batch-item">
            <input type="hidden" name="questionId[]" value="3">
          </td>
          <td class="seq"><?= Html::encode($item->seq) ?></td>
          <td>
                <?php if ($item->question->type == 'fill') : ?>
                    <?= Html::encode(FillQuestion::stemTextFilter($item->question->stem, 20)) ?>
                <?php else : ?>
                    <?= Html::encode(Helper::truncate_utf8_string($item->question->stem, 20)) ?>
                <?php endif; ?>
          </td>
          <td><?= Html::encode(Helper::getDict('questionType', $item->question->type)) ?></td>
          <td><?= Html::encode(Helper::getDict('difficulty', $item->question->difficulty)) ?></td>
          <td>
            <input name="scores[]" class="notMoveHandle form-control input-sm" type="text" value="<?= Html::encode($item->score) ?>" data-miss-score="0">
          </td>
          <td>
            <div class="btn-group">
                <?= Html::a('预览', ['question/view', 'id' => $item->question->id, 'type' => $item->question->type], ['class' => 'btn btn-default btn-sm']) ?>
                <?= Html::a('移除', ['remove', 'id' => $item->id], ['class' => 'btn btn-default btn-sm', 'data' => ['confirm' => '你确定要移除这个题目吗？', 'method' => 'post']]) ?>
                <a href="javascript:" class="notMoveHandle btn btn-default btn-sm" data-role="pick-item" data-url="/course/2/manage/testpaper/1/item_picker?replace=3">替换</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? '保存' : '保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'question-btn']) ?>
</div>

<?php ActiveForm::end(); ?>