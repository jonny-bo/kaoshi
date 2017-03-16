<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Question */

$this->title = '添加题目';
$this->params['breadcrumbs'][] = ['label' => '题库管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render($type.'_form', [
        'model' => $model,
        'type'  => $type
    ]) ?>

</div>
