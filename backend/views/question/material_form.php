<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'target')->hiddenInput(['value'=> 'questions'])->label(false) ?>

    <?= $form->field($model, 'type')->hiddenInput(['value'=> $type])->label(false) ?>

    <?= $form->field($model, 'difficulty')->radioList(['simple'=>'简单', 'normal'=>'一般', 'difficulty'=>'困难']) ?>

    <?= $form->field($model, 'stem')->label('材料')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'score')->textInput(['value' => 2]) ?>

    <?= $form->field($model, 'parentId')->hiddenInput(['value'=> 0])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '保存并添加子题' : '保存', ['class' => 'btn btn-success']) ?>
        <?php if (!$model->isNewRecord) : ?>
            <?= Html::a('管理子题', ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif  ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
