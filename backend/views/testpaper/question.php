<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use backend\assets\AppAsset;

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
        'page'  => 'question'
    ]) ?>
</div>
<div class="col-md-9">
    <div class="panel panel-default panel-col">
        <div class="panel-heading">题目设置</div>
        <div class="panel-body">
            <ul class="nav nav-pills nav-mini">
                <li class="<?= $type == 'rand' ? 'active' : '' ?>">
                    <?= Html::a('题库随机', ['question', 'id' => $model->id, 'type' => 'rand'], ['class' => 'testpaper-nav-link']) ?>
                </li>
                <li class="<?= $type == 'select' ? 'active' : '' ?>">
                    <?= Html::a('手动选择', ['question', 'id' => $model->id, 'type' => 'select'], ['class' => 'testpaper-nav-link']) ?>
                </li>
            </ul>
            <?= $this->render("question/{$type}.php", [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>