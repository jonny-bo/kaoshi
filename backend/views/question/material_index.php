<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
AppAsset::register($this);
AppAsset::addJs($this, Yii::$app->request->baseUrl."/js/short-long.js");

$this->title = '材料题';
$this->params['breadcrumbs'] = [
    ['label' => '题库管理', 'url' => ['question/index']],
    $this->title
];
?>
<div class="question-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> 选择题', ['create', 'type' => 'choice', 'parentId' => $model->id], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> 填空题', ['create', 'type' => 'fill', 'parentId' => $model->id], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> 问答题', ['create', 'type' => 'essay', 'parentId' => $model->id], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> 判断题', ['create', 'type' => 'determine', 'parentId' => $model->id], ['class' => 'btn btn-info btn-sm']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="shor-long">
      <div class="well well-sm short-long-text">
        <div class="short-text" style="display: block;">
            <?= $model->getFilterStem(140) ?> 
        <span class="trigger">(展开)</span></div>
        <div class="long-text" style="display: none;"><p>
            <?= $model->stem ?></p>
        <span class="trigger">(收起)</span></div>
      </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=> '{items}<div class="text-right tooltip-demo">{pager}</div>',
        'pager'=>[
            'firstPageLabel'=>"首页",
            'prevPageLabel' =>'上一页',
            'nextPageLabel' =>'下一页',
            'lastPageLabel' =>'尾页',
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['width' => '5%']
            ],
            [
                'attribute' => 'type',
                'headerOptions' => ['width' => '12%'],
                'filter' => [
                    'choice'    => '选择题',
                    'fill'      => '填空题',
                    'essay'     => '问答题',
                    'determine' => '判断题',
                    'material'  => '材料题',
                ],
                'value' => function ($data, $key, $index, $column) {
                    if ($data->type == 'choice') {
                        return '选择题';
                    } else if ($data->type == 'fill') {
                        return '填空题';
                    } else if ($data->type == 'essay') {
                        return '问答题';
                    } else if ($data->type == 'determine') {
                        return '判断题';
                    } else if ($data->type == 'material') {
                        return '材料题';
                    }
                }
            ],
            [
                'attribute' => 'stem',
                'format' => 'html',
                'headerOptions' => ['width' => '38%'],
                'value' => function ($data) {
                    return $data->getFilterStem();
                }
            ],
            [
                'attribute' => 'difficulty',
                'filter' => [
                    'simple'    => '简单',
                    'normal'      => '普通',
                    'difficulty'     => '困难',
                ],
                'headerOptions' => ['width' => '10%'],
                'value' => function ($data) {
                    if ($data->difficulty == 'simple') {
                        return '简单';
                    } else if ($data->difficulty == 'normal') {
                        return '普通';
                    } else if ($data->difficulty == 'difficulty') {
                        return '困难';
                    } else {
                        return '普通';
                    }
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
                                'confirm' => '你确定要删除题目吗？',
                                'method' => 'post',
                            ]
                        ]
                    );
                },
                'update' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="glyphicon glyphicon-edit"></i> 编辑',
                        ['update', 'id' => $key, 'type' => $model->type],
                        [
                        'class' => 'btn btn-primary btn-sm'
                        ]
                    );
                },
                'view' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="glyphicon glyphicon-eye-open"></i> 预览',
                        ['view', 'id' => $key, 'type' => $model->type],
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
