<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TestpaperSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testpaper-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'limitedTime') ?>

    <?= $form->field($model, 'pattern') ?>

    <?php // echo $form->field($model, 'target') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'passedScore') ?>

    <?php // echo $form->field($model, 'itemCount') ?>

    <?php // echo $form->field($model, 'createdUserId') ?>

    <?php // echo $form->field($model, 'createdTime') ?>

    <?php // echo $form->field($model, 'updatedUserId') ?>

    <?php // echo $form->field($model, 'updatedTime') ?>

    <?php // echo $form->field($model, 'metas') ?>

    <?php // echo $form->field($model, 'copyId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
