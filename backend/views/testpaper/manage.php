<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\Testpaper */

$this->params['breadcrumbs'][] = ['label' => '考试管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '管理';
?>
<div class="manage-header">
    <?= $this->render('manage-header.php', [ 'model' => $model]) ?>
</div>
<div class="col-md-3">
    <?= $this->render('left-menu.php', [
        'model' => $model,
        'page'  => 'base'
    ]) ?>
</div>
<div class="col-md-9">
    <div class="panel panel-default panel-col">
        <div class="panel-heading">基本信息</div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?php if (isset($notify)) : ?>
                <div class="alert alert-<?=$notify['type']?>"><?=$notify['msg']?></div>
            <?php endif; ?>
            
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic'
            ]) ?>

            <?= $form->field($model, 'limitedTime')->textInput(['maxlength' => true, 'style' => 'width:200px'])->label('限制时间:(分钟)') ?>
            <div class="help-block">0分钟，表示无限制</div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? '创建' : '保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
