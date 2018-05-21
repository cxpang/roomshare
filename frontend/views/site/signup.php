<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup  col-lg-5 col-lg-offset-2"  style="color: #FEFEFE;background-image: url(img/bg2.jpg);margin-top: 120px;font-size: 20px;">

    <div class="row">
        <div class="col-md-12" style="text-align: center"><h1>用户注册</h1></div>

        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('用户名') ?>

                <?= $form->field($model, 'email')->label('邮箱') ?>

                <?= $form->field($model, 'password')->passwordInput()->label()->label('密码') ?>
                <?= $form->field($model, 'repassword')->passwordInput()->label('请重复密码') ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6" style="margin-left: 20px">{input}</div></div>',
            ])->label('请输入验证码') ?>
                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
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
