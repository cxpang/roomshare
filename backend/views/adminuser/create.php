<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Adminuser */

$this->title = '创建管理员';
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adminuser-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
