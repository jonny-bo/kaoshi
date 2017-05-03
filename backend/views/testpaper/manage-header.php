<?php
use yii\helpers\Html;

$this->title = '管理 考试: ' . $model->name;
?>
<div class="es-section course-manage-header clearfix">
    <h1 class="title">
        <a class="link-dark" href="/course/2"><?= Html::encode($this->title) ?></a>
        <span class="label label-warning ">
            <?= Html::encode($model->getStatus()) ?>
        </span>
    </h1>
    <div class="teachers">
        创建人：<a href=""><?= Html::encode($model->user->username) ?></a>
    </div>
    <div class="toolbar hidden-xs">
        <div class="btn-group">
            <?php if ($model->status == 'close' || $model->status = 'draft') : ?>
                <?= Html::a('发布', ['open', 'id' => $model->id], [
                    'class' => 'btn btn-info btn-sm',
                    'data' => [
                        'confirm' => '你确定要发布这个考试？发布后将在前台被显示！',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php else : ?>
                <?= Html::a('关闭', ['close', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => '你确定要关闭这个考试？关闭后将在前台不被显示！',
                        'method' => 'post',
                    ],
                ]) ?>                
            <?php endif ?>
        </div>
    
        <div class="btn-group">
            <?= Html::a('预览', ['view', 'id' => $model->id], ['class' => 'btn btn-default btn-sm', 'target' => '_blank']) ?>
        </div>
    </div>
</div>