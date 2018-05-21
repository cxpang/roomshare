<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Room;
use common\helpers\CityArea;
use yii\helpers\Url;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'room_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'room_type')->dropDownList(Room::$ROOM_TYPE) ?>

    <?= $form->field($model, 'room_price')->textInput() ?>

    <?= $form->field($model, 'room_content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'room_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'room_images[]')->widget(FileInput::classname(), [
        'options' => ['multiple' => true],
        'pluginOptions' => [
            'showUpload' => false,
            //是否显示[选择]按钮,指input上面的[选择]按钮,非具体图片上的上传按钮
        ] ]
    )->label('选择图片的时候，请一次性选中多张'); ?>

    <?= $form->field($model, 'room_city')->dropDownList(CityArea::GetCity(), ['prompt'=>'请选择']); ?>

    <?= $form->field($model, 'room_area')->dropDownList(CityArea::GetArea($model->room_city)) ?>

    <?= $form->field($model, 'room_address')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'is_essence')->dropDownList(Room::$ROOM_ESSENCE) ?>

    <?= $form->field($model, 'is_comment')->dropDownList(Room::$ROOM_COMMENT) ?>
    <?= $form->field($model, 'is_over')->dropDownList(Room::$ROOM_OVER) ?>
    <?= $form->field($model, 'point_lng')->textInput() ?>
    <?= $form->field($model, 'point_lat')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = '
//分类
$("#room-room_city").change(function() {
  var room_city = $(this).val();//获取一级目录的值
  $("#room-room_area").html("<option value=\"\"></option>");//二级显示目录标签
  if (room_city > 0) {
    getCourse(room_city);//查询二级目录的方法
  }
});
   
function getCourse(room_city){
  var href = "'.Url::to(['/room/option']).'";//请求的地址
  $.ajax({
    "type" : "GET",
    "url"  : href,
    "data" : {room_city : room_city},//所需参数和类型
    success : function(d) {
      $("#room-room_area").append(d);//返回值输出
    }
  });
}
   
';
$this->registerJs($js);
?>
