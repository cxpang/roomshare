<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Feedback */

$this->title ="反馈id:". $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Feedbacks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'feed_content',
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
