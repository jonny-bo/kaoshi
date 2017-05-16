<?php
use yii\helpers\Html;
?>
<div class="sidenav locked">
    <ul class="list-group">
        <li class="list-group-heading">考试信息</li>
        <li class="list-group-item <?= $page == 'base' ? 'active' : '' ?>">
            <?= Html::a('基本信息', ['manage', 'id' => $model->id]) ?>
        </li>
        <li class="list-group-item <?= $page == 'question' ? 'active' : '' ?>">
            <?= Html::a('题目设置', ['question', 'id' => $model->id]) ?>
        </li>
        <li class="list-group-item <?= $page == 'examset' ? 'active' : '' ?>">
            <?= Html::a('试卷设置', ['examset', 'id' => $model->id]) ?>
        </li>
        <li class="list-group-item <?= $page == 'user' ? 'active' : '' ?>">
            <?= Html::a('批阅试卷', ['user', 'id' => $model->id]) ?>
        </li>
    </ul>
</div>