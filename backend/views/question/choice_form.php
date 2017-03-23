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

    <?= $form->field($model, 'stem')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'choice[0]')->label('选项A')->textInput() ?>

    <?= $form->field($model, 'answeres[1]')->checkbox() ?>

    <?= $form->field($model, 'choice[1]')->label('选项B')->textInput() ?>

    <?= $form->field($model, 'answeres[2]')->checkbox() ?>

    <?= $form->field($model, 'choice[2]')->label('选项C')->textInput() ?>

    <?= $form->field($model, 'answeres[3]')->checkbox() ?>

    <?= $form->field($model, 'choice[3]')->label('选项D')->textInput() ?>

    <?= $form->field($model, 'answeres[4]')->checkbox() ?>

    <?= $form->field($model, 'analysis')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'score')->textInput(['value' => 2]) ?>

    <?= $form->field($model, 'parentId')->hiddenInput(['value'=> $parentId])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
