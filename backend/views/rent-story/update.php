<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RentStory */

$this->title = '更新租房故事';
$this->params['breadcrumbs'][] = ['label' => '租房故事', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->story_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rent-story-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
