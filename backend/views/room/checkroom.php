<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Room;
use yii\helpers\Url;
use yii\widgets\DetailView;
$this->title ="审核房间：". $model->room_name;
$this->params['breadcrumbs'][] = ['label' => '房间管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-form">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'room_id',
            'user_id',
            'room_name',
            [
                'attribute'=>'room_type',
                'format' => ['raw',],
                'value'=>function($model){
                    return Room::$ROOM_TYPE[$model->room_type];
                },
            ],
            'room_price',
            'room_content',
            'room_detail:ntext',
            [
                'attribute'=>'add_time',
                'format' => ['raw',],
                'value'=>date('Y-m-d,H:i:s',$model->add_time),
            ],
            [
                'attribute'=>'update_time',
                'format' => ['raw',],
                'value'=>date('Y-m-d,H:i:s',$model->update_time),
            ],
            [
                'attribute'=>'is_essence',
                'format' => ['raw',],
                'value'=>function($model){
                    return Room::$ROOM_ESSENCE[$model->is_essence];
                },
            ],
            [
                'attribute'=>'is_comment',
                'format' => ['raw',],
                'value'=>function($model){
                    return Room::$ROOM_COMMENT[$model->is_comment];
                },
            ],
            [
                'attribute'=>'is_over',
                'format' => ['raw',],
                'value'=>function($model){
                    return Room::$ROOM_OVER[$model->is_over];
                },
            ],
            'point_lng',
            'point_lat',
            [
                'attribute'=>'is_check',
                'format' => ['raw',],
                'value'=>function($model){
                    return Room::$ROOM_check[$model->is_check];
                },
            ],
        ],
    ]) ?>
    <h3>房间审核</h3>
    <?php $form = ActiveForm::begin(['method' => "post",'action'=>Url::to(['room/checkresult'])]); ?>
    <?= $form->field($model, 'room_id')->textInput(['maxlength' => true,'readonly' => true]) ?>

    <?= $form->field($model, 'room_name')->textInput(['maxlength' => true,'readonly' => true]) ?>
    <?= $form->field($model, 'room_content')->textInput(['maxlength' => true,'readonly' => true]) ?>

    <?= $form->field($model, 'room_detail')->textarea(['rows' => 6,'readonly' => true]) ?>
    <?= $form->field($roomcheck, 'is_check')->dropDownList(Room::$ROOM_check) ?>
    <?= $form->field($roomcheck, 'check_info')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>