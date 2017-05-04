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
        'page'  => 'examset'
    ]) ?>
</div>
<div class="col-md-9">
    <div class="panel panel-default panel-col">
        <div class="panel-heading">考试设置</div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            
            <?= $form->field($model, 'score')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'passedScore')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'limitedTime')->textInput(['maxlength' => true, 'style' => 'width:200px'])->label('限制时间:(分钟)') ?>
            <div class="help-block">0分钟，表示无限制</div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? '创建' : '保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
