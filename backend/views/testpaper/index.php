<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TestpaperSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '考试管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testpaper-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增考试', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'name',
                'headerOptions' => ['width' => '40%']
            ],
            // 'description:ntext',
            // 'limitedTime:datetime',
            // 'pattern',
            // 'target',
            [
                'attribute' => 'status',
                'filter' => [
                    'draft' => '草稿',
                    'open'  => '已发布',
                    'close' => '已关闭',
                ],
                'value' => function ($data) {
                    if ($data->status == 'draft') {
                        return '草稿';
                    } else if ($data->status == 'open') {
                        return '已发布';
                    } else if ($data->status == 'close') {
                        return '已关闭';
                    }
                }
            ],
            [
                'label'=>'题目统计',
                'attribute' => 'itemCount',
                'filter' => false, //不显示搜索框
                'value' => function ($data) {
                    return "{$data->itemCount}题/{$data->score}分";
                }
            ],
            [
                'label'=>'时间限制',
                'attribute' => 'limitedTime',
                'filter' => false, //不显示搜索框
                'value' => function ($data) {
                    return "{$data->limitedTime}分钟";
                }
            ],
            [
                'label'=>'更新人',
                'attribute' => 'username',
                'headerOptions' => ['width' => '10%'],
                'value' => 'user.username' //关联表
            ],
            [
                'label'=>'更新时间',
                'attribute' => 'updatedTime:datetime',
                'headerOptions' => ['width' => '10%'],
                'filter' => false, //不显示搜索框
                'value' => function ($data) {
                    return date('Y-m-d H:i:s', $data->updatedTime);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update} {delete}',
                'headerOptions' => ['width' => '15%'],
                'buttons' => [
                'delete' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="glyphicon glyphicon-trash"></i> 删除',
                        ['delete', 'id' => $key],
                        [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => '你确定要删除考试吗？',
                                'method' => 'post',
                            ]
                        ]
                    );
                },
                'update' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="glyphicon glyphicon-th-list"></i> 管理',
                        ['manage', 'id' => $key],
                        [
                        'class' => 'btn btn-primary btn-sm'
                        ]
                    );
                },
                'view' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="glyphicon glyphicon-eye-open"></i> 预览',
                        ['view', 'id' => $key],
                        [
                        'class' => 'btn btn-info btn-sm'
                        ]
                    );
                },
                ],
            ],
        ],
    ]); ?>
</div>
