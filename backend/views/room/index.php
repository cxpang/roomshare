<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Room;
use common\helpers\CityArea;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '房间管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增合租', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'room_id',
            'user_id',
            ['label'=>'发布人', 'attribute' => 'user_name', 'value' => 'user.username',
                'filter'=>Html::activeTextInput($searchModel, 'user_name',['class'=>'form-control']) ],
            'room_name',
            [
                'attribute'=>'room_type',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return Room::$ROOM_TYPE[$dataProvider->room_type];
                },
                'filter' => Room::$ROOM_TYPE,//重点在这里，传入一个数组，会下拉框显示
                'headerOptions' => ['width' => '7%']
            ],
            'room_price',
//            'room_content',
//            'room_detail:ntext',
            [
                'attribute'=>'room_images',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    $array=explode(",",$dataProvider->room_images);

                    return Html::img("/roomshare/uploads/".$array[0],['alt' => '缩略图','width' => 80]);
                }
            ],
            [
                'attribute'=>'room_city',
                'value'=>'city.city',
                'filter' => CityArea::GetCity(),
                'headerOptions' => ['width' => '7%']
            ],
            [
                'attribute'=>'room_area',
                'value'=>'area.area',

            ],
            'room_address',
//            'add_time:datetime',
//            'update_time:datetime',
//            'answer_counts',
//            'answer_users',
//            'focus_count',
//            'comment_count',
            [
                'attribute'=>'is_essence',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return Room::$ROOM_ESSENCE[$dataProvider->is_essence];
                },
                'filter' => Room::$ROOM_ESSENCE,//重点在这里，传入一个数组，会下拉框显示
                'headerOptions' => ['width' => '7%']
            ],
            [
                'attribute'=>'is_comment',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return Room::$ROOM_COMMENT[$dataProvider->is_comment];
                },
                'filter' => Room::$ROOM_COMMENT,//重点在这里，传入一个数组，会下拉框显示
                'headerOptions' => ['width' => '7%']
            ],
            [
                'attribute'=>'is_over',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return Room::$ROOM_OVER[$dataProvider->is_over];
                },
                'filter' => Room::$ROOM_OVER,//重点在这里，传入一个数组，会下拉框显示
                'headerOptions' => ['width' => '7%']
            ],
            [
                'attribute'=>'is_check',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return Room::$ROOM_check[$dataProvider->is_check];
                },
                'filter' => Room::$ROOM_check,//重点在这里，传入一个数组，会下拉框显示
                'headerOptions' => ['width' => '7%']
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}{checkroom}',
                'buttons'=>[
                    'checkroom'=>function($url,$model,$key){
                        $options=[
                            'title'=>Yii::t('yii','审核'),
                            'aria-label'=>Yii::t('yii','审核'),
                            'data-pjax'=>'0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-cog">',$url,$options);
                    }

                ]
            ],

        ],
    ]); ?>
</div>