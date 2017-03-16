<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\QuestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'stem') ?>

    <?= $form->field($model, 'score') ?>

    <?= $form->field($model, 'answer') ?>

    <?php // echo $form->field($model, 'analysis') ?>

    <?php // echo $form->field($model, 'metas') ?>

    <?php // echo $form->field($model, 'categoryId') ?>

    <?php // echo $form->field($model, 'difficulty') ?>

    <?php // echo $form->field($model, 'target') ?>

    <?php // echo $form->field($model, 'parentId') ?>

    <?php // echo $form->field($model, 'subCount') ?>

    <?php // echo $form->field($model, 'finishedTimes') ?>

    <?php // echo $form->field($model, 'passedTimes') ?>

    <?php // echo $form->field($model, 'userId') ?>

    <?php // echo $form->field($model, 'updatedTime') ?>

    <?php // echo $form->field($model, 'createdTime') ?>

    <?php // echo $form->field($model, 'copyId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
