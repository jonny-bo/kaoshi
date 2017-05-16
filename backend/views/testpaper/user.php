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
        'page'  => 'user'
    ]) ?>
</div>
<div class="col-md-9">
    <div class="panel panel-default panel-col">
        <div class="panel-heading">考生试卷信息</div>
        <div class="panel-body">
            <table id="user-table" class="table table-striped table-hover" data-search-form="#user-search-form">
              <thead>
              <tr>
                <th>用户名</th>
                <th>邮箱</th>
                <th>试卷名</th>
                <th>考试时间</th>
                <th>用户成绩</th>
                <th width="10%">操作</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($itemResults as $itemResult) : ?>
                <tr>
                  <td><?=$itemResult->user->username?></td>
                  <td><?=$itemResult->user->email?></td>
                  <td><?=$itemResult->paperName?></td>
                  <td><?=date('Y-m-d H:i:s', $itemResult->beginTime)?></td>
                  <td>
                    <?php if ($itemResult->score) : ?>
                        <?=$itemResult->score?>
                    <?php else : ?>
                      '未批阅'
                    <?php endif; ?>  
                  </td>
                  <td>
                    <?= Html::a('立即批阅', ['review', 'id' => $model->id, 'userId' => $itemResult->userId ], ['class' => 'btn btn-primary btn-sm']) ?>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
        </div>
    </div>
</div>
