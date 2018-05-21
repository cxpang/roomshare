<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '用户登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login  col-lg-5 col-lg-offset-2" style="color: #FEFEFE;background-image: url(img/bg2.jpg);margin-top: 120px;font-size: 20px;">
    <div class="row" >
        <div class="col-md-12" style="text-align: center"><h1>用户登录</h1></div>
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username',['labelOptions'=>['class'=>'glyphicon glyphicon-user']])->textInput(['autofocus' => true])->label('用户名') ?>

                <?= $form->field($model, 'password',['labelOptions'=>['class'=>'glyphicon glyphicon-lock']])->passwordInput()->label('密码') ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('记住我') ?>

                <div style="color:#999;margin:1em 0">
                    忘记密码？ <?= Html::a('找回密码', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<style>
    body{
        background-image:url(/roomshare/uploads/picjumbo-bg5.jpg);
        background-position: center 0;
        background-repeat: no-repeat;
        background-attachment:fixed;
        background-size: cover;
        -webkit-background-size: cover;/* 兼容Webkit内核浏览器如Chrome和Safari */
        -o-background-size: cover;/* 兼容Opera */
    }
</style>

