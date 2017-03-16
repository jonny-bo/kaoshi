<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Testpaper */

$this->title = '更新 试卷: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '试卷管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="testpaper-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
