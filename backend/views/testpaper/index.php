<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TestpaperSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '试卷管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testpaper-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增试卷', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            // 'description:ntext',
            // 'limitedTime:datetime',
            // 'pattern',
            // 'target',
            'status',
            // 'score',
            // 'passedScore',
            'itemCount',
            'createdUserId',
            // 'createdTime:datetime',
            'updatedUserId',
            // 'updatedTime:datetime',
            // 'metas:ntext',
            // 'copyId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
