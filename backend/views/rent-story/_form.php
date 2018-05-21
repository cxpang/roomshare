<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\RentStory;

/* @var $this yii\web\View */
/* @var $model common\models\RentStory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rent-story-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'story_name')->textInput() ?>

    <?= $form->field($model, 'story_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'support_counts')->textInput() ?>

    <?= $form->field($model, 'love_counts')->textInput() ?>

    <?= $form->field($model, 'is_star')->dropDownList(RentStory::$IS_STAR) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
