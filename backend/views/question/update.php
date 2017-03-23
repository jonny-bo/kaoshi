<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Question */

$this->title = '更新 题目: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '题库管理', 'url' => ['index']];
if ($model->parentId) {
    $this->params['breadcrumbs'][] = ['label' => '材料题', 'url' => ['index', 'id' => $model->parentId]];
}
$this->params['breadcrumbs'][] = '更新';
?>
<div class="question-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render($type.'_form', [
        'model' => $model,
        'type'  => $type,
        'parentId' => $model->parentId
    ]) ?>

</div>
