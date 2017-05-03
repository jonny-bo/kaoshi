<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Testpaper */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '试卷预览', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testpaper-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'limitedTime:datetime',
            'pattern',
            'target',
            'status',
            'score',
            'passedScore',
            'itemCount',
            'createdUserId',
            'createdTime:datetime',
            'updatedUserId',
            'updatedTime:datetime',
            'metas:ntext',
            'copyId',
        ],
    ]) ?>

</div>
