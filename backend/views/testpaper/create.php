<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Testpaper */

$this->title = '新建 考试';
$this->params['breadcrumbs'][] = ['label' => '考试管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testpaper-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
