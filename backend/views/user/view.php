<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title ='用户详细信息';
$this->params['breadcrumbs'][] = ['label' => '普通用户', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除这条记录吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            [
                'attribute' => 'role',
                'value' => function($model) {
                    return $model->role == 10 ? '普通用户' : '管理员';
                },
            ],
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->status == 0 ? '无效用户' : '有效用户';
                },
            ],
            [
                'attribute' => 'created_at',
                'value' => date('Y-m-d H:i:s',$model->created_at)
            ],
            [
                'attribute' => 'updated_at',
                'value' => date('Y-m-d H:i:s',$model->updated_at)
            ],
        ],
    ]) ?>

</div>
