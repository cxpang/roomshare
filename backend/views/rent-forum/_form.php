<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\RentForum;

/* @var $this yii\web\View */
/* @var $model common\models\RentForum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rent-forum-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'forum_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'forum_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'forum_people_counts')->textInput() ?>

    <?= $form->field($model, 'forum_star')->dropDownList(RentForum::$IS_STAR) ?>

    <?= $form->field($model, 'forum_check')->dropDownList(RentForum::$IS_CHECK) ?>

    <?= $form->field($model, 'forum_check_message')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
