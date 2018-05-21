<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RentForumSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rent-forum-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'forum_id') ?>

    <?= $form->field($model, 'forum_name') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'forum_content') ?>

    <?= $form->field($model, 'forum_people_counts') ?>

    <?php // echo $form->field($model, 'forum_star') ?>

    <?php // echo $form->field($model, 'forum_check') ?>

    <?php // echo $form->field($model, 'forum_check_message') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
