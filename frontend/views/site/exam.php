<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\assets\AppAsset;

AppAsset::register($this);
AppAsset::addCss($this, "css/question.css");
AppAsset::addCss($this, "css/site.css");
AppAsset::addJs($this, "js/site.js");
$type = 'exam';

$this->title = $testpaper->name;
?>

<?= $this->render('@backend/views/testpaper/view', [
    'model' => $testpaper,
    'label' => '考试',
    'beginTime' => $beginTime
]) ?>
