<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RentForum */

$this->title = '新增论坛';
$this->params['breadcrumbs'][] = ['label' => 'Rent Forums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-forum-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
