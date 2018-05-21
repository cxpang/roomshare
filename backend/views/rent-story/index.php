<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\RentStory;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RentStorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '合租故事';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-story-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建合租故事', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'user_id',
            ['label'=>'发布人', 'attribute' => 'user_name', 'value' => 'user.username',
                'filter'=>Html::activeTextInput($searchModel, 'user_name',['class'=>'form-control']) ],

            'story_name',
//            'story_text:ntext',
            'support_counts',
            'love_counts',
            [
                'attribute'=>'is_star',
                'format' => ['raw',],
                'value'=>function($dataProvider){
                    return RentStory::$IS_STAR[$dataProvider->is_star];
                },
                'filter' => RentStory::$IS_STAR,//重点在这里，传入一个数组，会下拉框显示
                'headerOptions' => ['width' => '10%']
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
