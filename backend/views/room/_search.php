<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RoomSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'room_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'room_name') ?>

    <?= $form->field($model, 'room_type') ?>

    <?= $form->field($model, 'room_price') ?>

    <?php // echo $form->field($model, 'room_content') ?>

    <?php // echo $form->field($model, 'room_detail') ?>

    <?php // echo $form->field($model, 'room_images') ?>

    <?php // echo $form->field($model, 'room_city') ?>

    <?php // echo $form->field($model, 'room_area') ?>

    <?php // echo $form->field($model, 'room_address') ?>

    <?php // echo $form->field($model, 'add_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'answer_counts') ?>

    <?php // echo $form->field($model, 'answer_users') ?>

    <?php // echo $form->field($model, 'focus_count') ?>

    <?php // echo $form->field($model, 'comment_count') ?>

    <?php // echo $form->field($model, 'is_essence') ?>

    <?php // echo $form->field($model, 'is_comment') ?>

    <div class="form-group">
        <?= Html::submitButton('查询', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
