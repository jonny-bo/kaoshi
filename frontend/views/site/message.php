<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\assets\AppAsset;

AppAsset::register($this);
AppAsset::addCss($this, "css/question.css");
AppAsset::addCss($this, "css/site.css");
$type = 'exam';

$this->title = $testpaper->name;
?>

<div class="es-section testpaper-heading">
    <div class="testpaper-titlebar clearfix">
        <h1 class="testpaper-title">
            <?=$this->title?><br>
          <small class="text-sm"></small>
        </h1>
    </div>
    <div class="testpaper-description"><p><?=$testpaper->description?></p>
</div>
  <div class="testpaper-metas" style="font-size: 24px;">
    <?php if ($itemResult->score) : ?>
        您的考试成绩：<?=$itemResult->score?>
            <?php if ($itemResult->passedStatus == 'passed') : ?>
               <p class="text-success">通过</p>
            <?php else : ?>
               <p class="text-danger">未通过</p>
            <?php endif; ?> 
    <?php else : ?>
      还未批阅
    <?php endif; ?>   
  </div>
</div>