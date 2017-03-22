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

    <div class="help-block">
        点击编辑器按钮 
        <span style="color:red">[ ]</span>  可以插入填空项；也可手工输入，例如“今年是[[2014|马]]年”，回答“2014”或者“马”都算答对
    </div>

    <?= $form->field($model, 'analysis')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'score')->textInput(['value' => 2]) ?>

    <?= $form->field($model, 'parentId')->hiddenInput(['value'=> 0])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
