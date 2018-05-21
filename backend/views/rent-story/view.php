<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RentStory */

$this->title = $model->story_name;
$this->params['breadcrumbs'][] = ['label' => '租房故事', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-story-view">


    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除这个故事吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'story_name',
            'story_text:ntext',
            'support_counts',
            'love_counts',
            [
                'attribute'=>'create_at',
                'format' => ['raw',],
                'value'=>date('Y-m-d,H:i:s',$model->create_at),
            ],
            [
                'attribute'=>'is_star',
                'format' => ['raw',],
                'value'=>function($model){
                    return \common\models\RentStory::$IS_STAR[$model->is_star];
                },
            ],
        ],
    ]) ?>

</div>
