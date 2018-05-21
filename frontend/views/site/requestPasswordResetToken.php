<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '找回密码';
$this->params['breadcrumbs'][] = $this->title;
?>
<div style="text-align: center;font-size: 20px">
<?php
//     foreach(Yii::$app()->session->getFlashes() as $key => $message) {
//         echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
//     }
foreach (Yii::$app->session->getAllFlashes() as $key=>$message){
    echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
}
?>
</div>
<div class="site-request-password-reset col-lg-5 col-lg-offset-2" style="margin-top: 120px">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请输入用户名和注册邮箱.</p>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('用户名') ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => false])->label('邮箱') ?>

                <div class="form-group">
                    <?= Html::submitButton('发送邮件', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
