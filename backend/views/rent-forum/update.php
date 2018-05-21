<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RentForum */

$this->title = '更新论坛';
$this->params['breadcrumbs'][] = ['label' => '论坛管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->forum_id, 'url' => ['view', 'id' => $model->forum_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rent-forum-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
