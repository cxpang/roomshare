<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RentStory */

$this->title = '新增合租故事';
$this->params['breadcrumbs'][] = ['label' => '合租故事', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-story-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
