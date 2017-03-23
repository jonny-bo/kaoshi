<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\assets\AppAsset;

AppAsset::register($this);
AppAsset::addCss($this, Yii::$app->request->baseUrl."/css/question.css");

/* @var $this yii\web\View */
/* @var $model backend\models\Question */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '题目', 'url' => ['index']];
if ($model->parentId) {
    $this->params['breadcrumbs'][] = ['label' => '材料题', 'url' => ['index', 'id' => $model->parentId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testpaper-question testpaper-question-choice">
    <?= $this->render($model->type.'_view', [
        'model' => $model
    ]) ?>    
</div>
