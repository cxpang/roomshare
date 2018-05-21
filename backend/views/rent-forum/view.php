<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\RentForum;

/* @var $this yii\web\View */
/* @var $model common\models\RentForum */

$this->title = $model->forum_id;
$this->params['breadcrumbs'][] = ['label' => '论坛管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-forum-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->forum_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->forum_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'forum_id',
            'forum_name',
            'user_id',
            'forum_content:ntext',
            'forum_people_counts',
            [
                'attribute'=>'forum_star',
                'format' => ['raw',],
                'value'=>function($model){
                    return RentForum::$IS_STAR[$model->forum_star];
                },
            ],
            [
                'attribute'=>'forum_check',
                'format' => ['raw',],
                'value'=>function($model){
                    return RentForum::$IS_CHECK[$model->forum_check];
                },
            ],
            'forum_check_message',
            [
                'attribute'=>'created_at',
                'format' => ['raw',],
                'value'=>date('Y-m-d,H:i:s',$model->created_at),
            ],
            [
                'attribute'=>'updated_at',
                'format' => ['raw',],
                'value'=>date('Y-m-d,H:i:s',$model->updated_at),
            ],
        ],
    ]) ?>

</div>
