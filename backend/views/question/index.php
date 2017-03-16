<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '题库管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> 选择题', ['create', 'type' => 'choice'], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> 填空题', ['create', 'type' => 'fill'], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> 问答题', ['create', 'type' => 'essay'], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> 判断题', ['create', 'type' => 'determine'], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> 材料题', ['create', 'type' => 'material'], ['class' => 'btn btn-info btn-sm']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout'=> '{items}<div class="text-right tooltip-demo">{pager}</div>',
        'pager'=>[
            //'options'=>['class'=>'hidden']//关闭分页
            'firstPageLabel'=>"First",
            'prevPageLabel' =>'Prev',
            'nextPageLabel' =>'Next',
            'lastPageLabel' =>'Last',
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['width' => '5%']
            ],
            //['attribute' => 'id', 'headerOptions' => ['width' => '40']],
            [
                'attribute' => 'type',
                'headerOptions' => ['width' => '20%'],
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
            ['attribute' => 'stem', 'format' => 'html', 'headerOptions' => ['width' => '240']],
            ['attribute' => 'score', 'headerOptions' => ['width' => '50'],],
            ['attribute' => 'answer', 'format' => 'html', 'headerOptions' => ['width' => '200'],],
            // 'analysis:ntext',
            // 'metas:ntext',
            // 'categoryId',
            // 'difficulty',
            // 'target',
            // 'parentId',
            // 'subCount',
            // 'finishedTimes:datetime',
            // 'passedTimes:datetime',
            // 'userId',
            [
                'label'=>'更新时间',
                'attribute' => 'updatedTime:datetime',
                'headerOptions' => ['width' => '100'],
                'filter' => false, //不显示搜索框
                'value' => function ($data) {
                    return date('Y-m-d H:i:s', $data->updatedTime);
                }
            ],
            // 'createdTime:datetime',
            // 'copyId',

            // ['class' => 'yii\grid\ActionColumn'],
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => '操作',
              'template' => '{view} {update} {delete}',
              'headerOptions' => ['width' => '210'],
              'buttons' => [
                'delete' => function ($url, $model, $key) {
                    return Html::a(
                        '<i class="glyphicon glyphicon-trash"></i> 删除',
                        ['delete', 'id' => $key],
                        [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => ['confirm' => '你确定要删除题目吗？',]
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
