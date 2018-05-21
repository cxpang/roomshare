<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RentForumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '论坛管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-forum-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增论坛', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'forum_id',
            'forum_name',
            'user_id',
            'forum_people_counts',
            //'forum_star',
            //'forum_check',
            //'forum_check_message',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
