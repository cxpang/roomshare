<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
$resetLink1 ="http://cxpang.roomshare.com/index.php?r=site/reset-password&token=".$user->password_reset_token;
?>
<div class="password-reset">
    <p>您好 <?= Html::encode($user->username) ?>,</p>

    <p>请点击以下链接重置密码:</p>

    <p><?= Html::a(Html::encode($resetLink1), $resetLink1) ?></p>
</div>
