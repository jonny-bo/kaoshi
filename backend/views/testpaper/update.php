<?php

use yii\helpers\Html;

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

