<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = '在线预备党员考试系统';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>在线预备党员考试系统</h1>

        <p class="lead">请选择自己考试，并参加．．．</p>

    </div>

    <div class="body-content">

        <div class="row">
            <?php foreach ($testPaperes as $testPaper) : ?>
                <div class="col-lg-4">
                    <h3><?=$testPaper->name ?></h3>
                    <p><?=$testPaper->description ?></p>
                    <p>
                        <?= Html::a('立即参加&raquo;', ['exam', 'id' => $testPaper->id], ['class' => 'btn btn-default']) ?>
                    </p>
                </div>
            <?php endforeach ?>
        </div>

    </div>
</div>
