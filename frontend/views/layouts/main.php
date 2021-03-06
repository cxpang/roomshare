<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody();
?>
<div style="display: none;"><?php
    NavBar::begin();
    NavBar::end();
    ?></div>

<div class="htmleaf-container">
    <nav class="animenu">
        <button class="animenu__toggle">
            <span class="animenu__toggle__bar"></span>
            <span class="animenu__toggle__bar"></span>
            <span class="animenu__toggle__bar"></span>
        </button>
        <ul class="animenu__nav ">
            <li class="juzhong">
                <a href="index.php" class="xiugai" >校园合租</a>
            </li>
            <li class="juzhong">
                <a href="#" class="xiugai">地址</a>
                <ul class="animenu__nav__child">
                    <li><a href="<?=Url::to(['room/index','room_city'=>0]) ?>">全部</a></li>
                    <li><a href="<?=Url::to(['room/index','room_city'=>310100]) ?>">上海</a></li>
                    <li><a href="<?=Url::to(['room/index','room_city'=>110100]) ?>">北京</a></li>

                </ul>
            </li>
            <li class="juzhong">
                <a href="#" class="xiugai">论坛</a>
                <ul class="animenu__nav__child">
                    <li><a href="<?=Url::to(['rentforum/index']) ?>">租友论坛</a></li>
                </ul>
            </li>
            <li class="juzhong">
                <a href="#" class="xiugai">发现</a>
                <ul class="animenu__nav__child">
                  
                    <li><a href="<?=Url::to(['room/options','fineroom'=>1]) ?>">精品房源</a></li>
                    <li><a href="<?=Url::to(['rent-story/index']) ?>">租房故事</a></li>
                </ul>
            </li>
            <!--            --><?php
            //            if(Yii::$app->user->isGuest){
            //                echo '<li>'."<a href='index.php?r=/site/signup' style='margin-left: 900px;'>注册</a>".'</li>';
            //                echo '<li>'."<a href='index.php?r=/site/login' style='margin-left: 900px;'>登录</a>".'</li>';
            //            }
            //            else{
            //                echo '<li>'."<a href='index.php?r=/site/logout' style='margin-left: 900px;'>退出</a>".'</li>';
            //            }
            //            ?>
            <?php if(Yii::$app->user->isGuest){?>
                <li style="float: right;margin-top: 20px;">
                    <a href="index.php?r=/site/signup">注册</a>
                </li>
                <li style="float: right ;margin-top: 20px;">
                    <a href="index.php?r=site/login">登录</a>
                </li>
            <?php   }?>
            <?php if(!Yii::$app->user->isGuest){  ?>
                <li class="juzhong" style="float: right;margin-top: 20px;">
                    <a href="#"><img style="width: 50px;height: 50px;border-radius: 50%" src="<?=common\models\User::getuserinfo(Yii::$app->user->getId())->user_picture;?>"><?php echo Yii::$app->user->identity->username; ?></a>
                    <ul class="animenu__nav__child">
                        <li><a href="<?=Url::to(['person/index'])  ?>">个人中心</a></li>
                        <li><a href="<?=Url::to(['myroom/index'])  ?>">我的合租</a></li>
                        <li><a href="<?=Url::to(['myforum/index'])  ?>">我的论坛</a></li>
                        <li><a href="<?=Url::to(['chatpoint/index'])  ?>">我的聊天</a></li>
                        <li><?php   echo Html::beginForm(['/site/logout'], 'post').Html::submitButton(
                                    '退出' ,['class'=>'buttonlogout']
                                ).Html::endForm() ;     ?></li>
                    </ul>
                </li>

            <?php  }?>
        </ul>
    </nav>
</div>

<script type="text/javascript">
    (function(){
        var animenuToggle = document.querySelector('.animenu__toggle'),
            animenuNav    = document.querySelector('.animenu__nav'),
            hasClass = function( elem, className ) {
                return new RegExp( ' ' + className + ' ' ).test( ' ' + elem.className + ' ' );
            },
            toggleClass = function( elem, className ) {
                var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ' ) + ' ';
                if( hasClass(elem, className ) ) {
                    while( newClass.indexOf( ' ' + className + ' ' ) >= 0 ) {
                        newClass = newClass.replace( ' ' + className + ' ' , ' ' );
                    }
                    elem.className = newClass.replace( /^\s+|\s+$/g, '' );
                } else {
                    elem.className += ' ' + className;
                }
            },
            animenuToggleNav =  function (){
                toggleClass(animenuToggle, "animenu__toggle--active");
                toggleClass(animenuNav, "animenu__nav--open");
            }

        if (!animenuToggle.addEventListener) {
            animenuToggle.attachEvent("onclick", animenuToggleNav);
        }
        else {
            animenuToggle.addEventListener('click', animenuToggleNav);
        }
    })()
</script>

<div style="height:800px;">
    <?php echo $content; ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<style type="text/css">
    .juzhong{
        text-align: center;
    }
    .buttonlogout{
        font-size: 20px;
        cursor: pointer;
        width: 170px;
        height: 50px;
        border: none;
        color: #ffffff;
        background-color: rgba(0,0,0,0.0);
    }
    .footer{
        height:20%;
        background:#111;
        width: 100%;
        margin-top: 20px;
        margin-bottom: 0px;
        text-align: center;
    }
    .footerintro{
        display: inline-block;
        margin: 0 auto;
        margin-top: 20px;
        color: #ffffff;
        font-family: "Microsoft YaHei";
        font-size: 20px;
    }
    .footer2{
        display: inline-block;
        margin: 0 auto;
        margin-top: 20px;
        color: #ffffff;
        font-family: "Microsoft YaHei";
        font-size: 20px;
    }
    .showuser{
        display: inline-block;
        margin-top: 20px;
        color: #ffffff;
        font-family: "Microsoft YaHei";
        font-size: 20px;
    }
    .xiugai{
        margin-left: 20px;
        margin-right: 20px;
        margin-top: 20px;
        margin-bottom: 20px;
        font-family: "Microsoft YaHei";
    }
    body{
        margin:0;
        padding:0;
        height: 100%;
        background: rgb(0,0,0,,0.5);
    }
    *, *:after, *:before {
        box-sizing: border-box;
    }

    .animenu__toggle {
        display: none;
        cursor: pointer;
        background-color: #111;
        border: 0;
        padding: 10px;
        height: 40px;
        width: 40px;
    }
    .animenu__toggle:hover {
        background-color: #0186ba;
    }

    .animenu__toggle__bar {
        display: block;
        width: 20px;
        height: 2px;
        background-color: #fff;
        -webkit-transition:  0.15s cubic-bezier(0.75, -0.55, 0.25, 1.55);
        -o-transition:  0.15s cubic-bezier(0.75, -0.55, 0.25, 1.55);
        transition:  0.15s cubic-bezier(0.75, -0.55, 0.25, 1.55);
    }
    .animenu__toggle__bar + .animenu__toggle__bar {
        margin-top: 4px;
    }

    .animenu__toggle--active .animenu__toggle__bar {
        margin: 0;
        position: absolute;
    }
    .animenu__toggle--active .animenu__toggle__bar:nth-child(1) {
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .animenu__toggle--active .animenu__toggle__bar:nth-child(2) {
        opacity: 0;
    }
    .animenu__toggle--active .animenu__toggle__bar:nth-child(3) {
        -webkit-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }

    .animenu {
        display: block;
    }
    .animenu ul {
        padding: 0;
        list-style: none;
        font: 0px 'Open Sans', Arial, Helvetica;
    }
    .animenu li, .animenu a {
        display: inline-block;
        font-size: 25px;
    }
    .animenu a {
        color: #aaaaaa;
        text-decoration: none;
    }

    .animenu__nav {
        background-color: #111;
    }
    .animenu__nav > li {
        position: relative;
    }
    .animenu__nav > li > a {
        padding: 10px 30px;
        text-transform: uppercase;
    }
    .animenu__nav > li > a:first-child:nth-last-child(2):before {
        content: "";
        position: absolute;
        border: 4px solid transparent;
        border-bottom: 0;
        border-top-color: currentColor;
        top: 50%;
        margin-top: -2px;
        right: 10px;
    }
    .animenu__nav > li:hover > ul {
        opacity: 1;
        visibility: visible;
        margin: 0;
    }
    .animenu__nav > li:hover > a {
        color: #fff;
    }

    .animenu__nav__child {
        min-width: 100%;
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1;
        opacity: 0;
        visibility: hidden;
        margin: 20px 0 0 0;
        background-color: #373737;
        transition: margin .15s, opacity .15s;
    }
    .animenu__nav__child > li {
        width: 100%;
    }
    .animenu__nav__child > li:first-child > a:after {
        content: '';
        position: absolute;
        height: 0;
        width: 0;
        left: 1em;
        top: -6px;
        border: 6px solid transparent;
        border-top: 0;
        border-bottom-color: inherit;
    }
    .animenu__nav__child > li:last-child {
        border: 0;
    }
    .animenu__nav__child a {
        padding: 10px;
        width: 100%;
        border-color: #373737;
    }
    .animenu__nav__child a:hover {
        background-color: #0186ba;
        border-color: #0186ba;
        color: #fff;
    }

    @media screen and (max-width: 767px) {
        .animenu__toggle {
            display: inline-block;
        }

        .animenu__nav,
        .animenu__nav__child {
            display: none;
        }

        .animenu__nav {
            margin: 10px 0;
        }
        .animenu__nav > li {
            width: 100%;
            border-right: 0;
            border-bottom: 1px solid #515151;
        }
        .animenu__nav > li:last-child {
            border: 0;
        }
        .animenu__nav > li:first-child > a:after {
            content: '';
            position: absolute;
            height: 0;
            width: 0;
            left: 1em;
            top: -6px;
            border: 6px solid transparent;
            border-top: 0;
            border-bottom-color: inherit;
        }
        .animenu__nav > li > a {
            width: 100%;
            padding: 10px;
            border-color: #111;
            position: relative;
        }
        .animenu__nav a:hover {
            background-color: #0186ba;
            border-color: #0186ba;
            color: #fff;
        }

        .animenu__nav__child {
            position: static;
            background-color: #373737;
            margin: 0;
            transition: none;
            visibility: visible;
            opacity: 1;
        }
        .animenu__nav__child > li:first-child > a:after {
            content: none;
        }
        .animenu__nav__child a {
            padding-left: 20px;
            width: 100%;
        }
    }
    .animenu__nav--open {
        display: block !important;
    }
    .animenu__nav--open .animenu__nav__child {
        display: block;
    }

</style>
