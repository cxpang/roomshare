<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Room;
use common\models\City;
use common\models\Area;
/* @var $this yii\web\View */
/* @var $model common\models\Room */

$this->title = $model->room_name;
$this->params['breadcrumbs'][] = ['label' => '房间管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->room_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->room_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('审核', ['checkroom', 'id' => $model->room_id], ['class' => 'btn btn-warning']) ?>

    </p>

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
                'attribute'=>'room_city',
                'format' => ['raw',],
                'value'=>City::findCity($model->room_city),
            ],
            [
                'attribute'=>'room_area',
                'format' => ['raw',],
                'value'=>Area::findarea($model->room_area),
            ],
            'room_address',
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
            'answer_counts',
            'answer_users',

            'focus_count',
            'comment_count',
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
    <h1>房间照片</h1>
    <?php
       $imagestring=$model->room_images;
       $imagearray=explode(",",$imagestring);
       for($i=0;$i<count($imagearray)-1;$i++) {

           ?>

               <img class="img" src="/roomshare/uploads/<?php echo $imagearray[$i]?>">
           <?php
       }
    ?>

</div>
<style>
    .img{
        height: 200px;
        width: 200px;
        border-radius: 50%;
        margin:0 auto;
    }
</style>