<?php
use common\models\Feedback;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>校园合租首页</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
    <script src="js/jquery.quovolver.min.js"></script>
    <!--[if lt IE 9]-->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <!--[endif]-->
</head>
<body>
<!--header starts-->
<header class="main-header">
    <div class="backbg-color">
        <!--banner starts-->
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="banner-info text-center">
                        <h2><span class="grey">School Rent</span> <br /> make better rent for graduates</h2>
                    </div>
                    <div class="banner-heading text-center">
                        <h3>租房快捷通</h3>
                    </div>
                    <?php $form = ActiveForm::begin(['method' => "get",'action'=>Url::to(['room/search']),'options' => ['style' => 'margin-top: 10px;margin-bottom:10px;'] ]); ?>

                    <div class="banner-search col-md-offset-2 col-md-8 col-md-offset-2">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="room_name" class="form-control selltwo" placeholder="房间名">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-btn">
                                <button type="submit">搜索</button>
                            </div>
                        </div>
                    </div>
                    <?php $form = ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
    <!--banner ends-->
</header>
<!--header ends-->
<section class="intro-one">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="intro-text text-center">
                    <h3>校园合租，毕业生的合租平台</h3>
                    <p>在这里没有中介的烦恼，没有安全的担心 <span style="display:block;">快来找到你心仪的合租室友吧</span></p>
                </div>
            </div>
        </div>
    </div>
</section>






<section class="news" id="news">
    <div class="container">
        <div class="row">
            <div class="news-sec">
                <div class="col-md-12">
                    <div class="sec-head">
                        <h2>房间 <span>推荐</span></h2>
                        <hr></hr>
                    </div>
                </div>
                <div class="news-colm">
                    <div class="col-md-4">
                        <div class="news-itm">
                            <h4>浦东民生路附近别墅</h4>
                            <hr class="news-line"></hr>
                            <img src="/roomshare/uploads/fea1.jpg">
                            <p>所在地区环境清幽、民风淳朴。我们为您准备了30-50平方不同风格的房间。6个房间全部朝南并配有空调，网络投影仪，沙发，独立卫浴，部分房间还有宽大的阳台。300平方米的私人花园有亲水平台、果树、休闲椅、遮阳伞，您可以边喝咖啡边享受悠闲惬意的午后时光，体验真正的“朝迎日出，暮送晚霞”。

                                您能躺床上感受家庭影院的魅力，您还能在花园内享受下午茶、BBQ、钓鱼、麻将、K歌等娱乐活动。如果您是第一次来上海，只要您有需要，我会为您呈上我烧的地道上海美食。还可以为您设计小众游路线。蓝天碧水将是您家庭聚会，朋友聚餐，休闲旅游的最佳选择。
                            </p>
                            <a href="<?=Url::to(['room/detail','room_id'=>1])?>" class="nws-btn">进入房间</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="news-itm">
                            <h4>新江湾城时尚公寓</h4>
                            <hr class="news-line"></hr>
                            <img src="/roomshare/uploads/fea2.jpg">
                            <p>清澈湛蓝的纯净海洋、彩绘天空的蓝天白云，四周环海的美丽小岛～绿岛，热情亲切的人文风情，已让每位来访的旅人们留下深刻美好的印象，丰富的海洋、海岛生态资源更是应该惊喜连连，不论是夜访梅花鹿、饱览月光星语、探索海洋潮间带等，都将获得无限乐趣，这样无私浪漫的小岛，是您享受沉淀自我、尽情放松的渡假圣地。
                            </p>
                            <a href="<?=Url::to(['room/detail','room_id'=>2])?>" class="nws-btn">进入房间</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="news-itm">
                            <h4>zoe的微栈-近迪斯尼</h4>
                            <hr class="news-line"></hr>
                            <img src="/roomshare/uploads/fea3.jpg">
                            <p>
                                地处上海浦东11号线秀沿路地铁站正对面，小区离秀沿路地铁站仅100M,是您游玩迪斯尼的理想之选！到迪斯尼仅2站 8分钟即达 住屋精心装修 自住标准，三房两卫，房东自主经营，干净整洁 ：墙面选自正规商场百安居立邦高端金装五合一漆（1桶1000+！）；房间纯实木地板；每个房间带大窗户以及天窗；房间内床垫为宜家独立弹簧高级床垫  两个卫生间toto马桶以及科勒马桶 。因为自身也是二个宝宝的妈妈 所以都选用了对自家宝贝安全的材料装修 欢迎您带着孩子前来体验
                            </p>
                            <a href="<?=Url::to(['room/detail','room_id'=>3])?>" class="nws-btn">进入房间</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="appoin-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="footer-sec text-center">
<!--                    <h2></h2>-->
                    <p>如果您有更好的意见和建议，欢迎反馈给我们。请点击以下按钮，进入反馈页面</p>
                    <a id="modal-334462" href="#modal-container-334462" role="button" class="btn" data-toggle="modal"><i class="fa fa-book"></i>用户反馈</a>
                    <?php
                    //     foreach(Yii::$app()->session->getFlashes() as $key => $message) {
                    //         echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
                    //     }
                    foreach (Yii::$app->session->getAllFlashes() as $key=>$message){
                        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-4 column">
        </div>
        <div class="col-md-4 column">
            <div class="modal fade" id="modal-container-334462" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                用户反馈
                            </h4>

                        </div>
                        <div class="modal-body">
                            <?php
                            if(!Yii::$app->user->isGuest){
                            $model=new Feedback();
                            $form = ActiveForm::begin(['id' => 'searchform','action'=> yii\helpers\Url::to(['site/feedback']), 'method' => "post", 'options' => ['style' => 'margin-bottom:5px;']]); ?>

                            <div>尊敬的用户:<?=Yii::$app->user->identity->username?>,请输入您的反馈意见</div>
                            <?= $form->field($model, 'feed_content') ?>

                            <div class="form-group">
                                <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
                            </div>
                            <?php

                                ActiveForm::end();}
                                else{   ?>
                                    <span style="font-size: 20px" class="label label-warning">请点击右侧登录按钮</span>
                                    <span class="glyphicon glyphicon-hand-right"></span>
                                    <a href="<?=\yii\helpers\Url::to(['site/login'])?>"><span style="font-size: 20px" class="label label-primary">登陆</span></a>
                                <?php   }

                            ?>

                        </div>
                    </div>

                </div>

            </div>

        </div>
        <div class="col-md-4 column">

        </div>
    </div>
</div>
<!--listing section-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/jquery.mixitup.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.quovolver.js"></script>
<!--for smooth scrolling-->
<script>
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
</script>
<!--demo-->
<script>
    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            autoPlay: 4000,
            items : 4,
            itemsDesktop : [1199,3],
            itemsDesktopSmall : [979,3]
        });

    });

</script>

<script type="text/javascript">


    $(document).ready(function() {

        var owl = $("#owl-demo");

        owl.owlCarousel();

        // Custom Navigation Events
        $(".next").click(function(){
            owl.trigger('owl.next');
        })
        $(".prev").click(function(){
            owl.trigger('owl.prev');
        })

    });




</script>

<script type="text/javascript">
    $(function(){

        // Instantiate MixItUp:

        $('#Container').mixItUp();

    });
</script>
<script>
    jQuery(function ($) {
        // fancybox
        $(".fancybox").fancybox({
            modal: true, // disable regular nav and close buttons
            // add buttons helper (requires buttons helper js and css files)
            helpers: {
                buttons: {}
            }
        });
        // filter selector
        $(".filter").on("click", function () {
            var $this = $(this);
            // if we click the active tab, do nothing
            if ( !$this.hasClass("active") ) {
                $(".filter").removeClass("active");
                $this.addClass("active"); // set the active tab
                // get the data-rel value from selected tab and set as filter
                var $filter = $this.data("rel");
                // if we select view all, return to initial settings and show all
                $filter == 'all' ?
                    $(".fancybox")
                        .attr("data-fancybox-group", "gallery")
                        .not(":visible")
                        .fadeIn()
                    : // otherwise
                    $(".fancybox")
                        .fadeOut(0)
                        .filter(function () {
                            // set data-filter value as the data-rel value of selected tab
                            return $(this).data("filter") == $filter;
                        })
                        // set data-fancybox-group and show filtered elements
                        .attr("data-fancybox-group", $filter)
                        .fadeIn(1000);
            } // if
        }); // on
    }); // ready
</script>
<!--texitimonial-->
<script>


    $('.quotes').quovolver({
        equalHeight   : true
    });

</script>
<style>
    *
    {
        margin: 0px;
        padding: 0px;
    }
    body {
        color:#6F7478;
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        font-weight: 300;
    }
    ul, li, a
    {
        padding: 0px;
        margin: 0px;
    }
    a
    {
        color: rgba(248, 75, 74, 0.72);
        text-decoration: none;
    }
    a:hover
    {
        text-decoration: none;
        color: #F84B4A;
    }
    h1, h2, h3, h4, h5, h6
    {
        font-family: 'Roboto Slab', serif;
        font-weight: 300;
    }
    h2
    {
        color:#555;
        font-size: 24px;
        letter-spacing: 3px;
        padding: 0px;
        margin: 0px;
    }
    h3
    {
        font-family: 'Roboto Slab', serif;
        font-weight: 300;
        padding: 0px;
        margin: 0px;
    }
    img
    {
        width: 100%;
    }
    hr
    {
        width: 50px;
        height: 5px;
        background-color: #F84B4A;
        margin-bottom: 50px;
        border: none;
    }
    /**header section**/
    .main-header
    {
        background: url("/roomshare/uploads/picjumbo-bg5.jpg") 0% 0% / 100% no-repeat fixed;
        width: 100%;
        float: left;
        background-size: cover;
    }
    .backbg-color
    {
        width: 100%;
        float: left;
        background-color: rgba(37, 35, 50, 0.67);
        padding-bottom: 50px;
    }
    .main-header .navigation-bar
    {
        margin-top: 50px;
        width: 100%;
        float: left;
    }
    .main-header .navigation-bar .navbar-default {
        background-color: #fff;
        border-color: #ccc;
        border-radius: 2px;
    }
    .main-header .navigation-bar .navbar-default .navbar-brand {
        text-transform: uppercase;
        font-size: 24px;
        line-height: 20px;
        font-weight: 300;
    }
    .main-header .navigation-bar .navbar
    {
        margin: 0px;
        padding: 15px 0px;
    }
    .main-header .navigation-bar .navbar-default .navbar-nav > li
    {
        padding: 0px 10px;
    }
    .main-header .navigation-bar .navbar-default .navbar-nav > li > a {
        text-transform: uppercase;
        font-size: 12px;
        font-weight: 300;
        letter-spacing: 0.5px;
    }
    .main-header .navigation-bar .navbar-default #social > li > a
    {
    }
    .main-header .navigation-bar .navbar-default .navbar-nav > .active > a
    {
        color: #8FA5AF;
        background-color: #fff;
    }
    .grey {
        color: #F84B4A;
    }

    .main-header .banner-text
    {
        width: 100%;
        float: left;
        padding-top: 200px;
    }
    .copyrights{
        text-indent:-9999px;
        height:0;
        line-height:0;
        font-size:0;
        overflow:hidden;
    }
    .banner-info h2
    {
        color: #fff;
        font-size: 65px;
        padding-bottom: 150px;
    }
    .banner-info h2 span
    {
        font-weight: 600;
        font-family: 'Roboto Slab', serif;;
    }
    .main-header .banner-text .banner-heading h3
    {
        font-size: 28px;
        color: #FFF;
        padding-bottom: 15px;
    }
    .main-header .banner-text .banner-search
    {
        background: rgba(143, 165, 175, 0.33);
        padding: 15px 0px;
        border-radius: 5px;
    }
    .main-header .banner-text .banner-search .sellone
    {
        width: 100%;
        height: 50px;
        margin-top: 20px;
    }
    .main-header .banner-text .banner-search .selltwo
    {
        width: 100%;
        height: 50px;
        margin-top: 20px;
    }
    .main-header .banner-text .banner-search .form-btn button
    {
        width: 100%;
        height: 50px;
        margin-top: 20px;
        border: none;
        background-color: rgba(24, 25, 30, 0.7);
        color: #fff;
        transition: all 0.8s ease-in 0s;
    }
    .main-header .banner-text .banner-search .form-btn button:hover
    {
        background-color: #F84B4A;
        transition: all 0.8s ease-in 0s;
    }
    /**intro section**/
    .intro-one
    {
        width: 100%;
        float: left;
        background-color: #F84B4A;
        padding: 40px 0px;
        color:#fff;
    }
    /**feature section**/
    .feature
    {
        width: 100%;
        float: left;
        padding: 80px 0px;
    }
    .sec-head h2
    {
        font-size: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 300;
        padding: 0px;
        margin: 0px;
        font-weight: 400 !important;
        font-size: 25px;
    }
    .sec-head h2 span
    {
        font-weight: 600;
    }

    .feature .fea-head .fea-one
    {
        width: 100%;
        height: 60px;
    }
    #owl-demo .item
    {
        margin: 3px;
        box-shadow: 0px 0px 1px 2px rgba(26, 10, 10, 0.14)
    }
    #owl-demo .item img
    {
        display: block;
        width: 100%;
        height: auto;
    }

    #owl-demo .item .img-info
    {
        padding:10px 0px 10px 10px;
        text-align: center;
    }
    #owl-demo .item .img-info h4
    {
        color: rgba(39, 17, 17, 0.45);
        font-weight: 300;

    }
    /**agent section**/
    .agent
    {
        width: 100%;
        float: left;
        background: url("/roomshare/uploads/bg.jpg") no-repeat fixed;
        background-size: cover;
    }
    .agent .backbg
    {
        background-color: rgba(51, 30, 148, 0.15);
        padding: 80px 0px;
    }
    .agent .backbg h2 {
        font-size: 30px;
        text-transform: uppercase;
        color: #fff;
        letter-spacing: 5px;
        margin: 0px;
        font-weight: 300;
    }
    .agent .backbg .agent-sec h2 span
    {
        font-weight: 600;
    }
    .agent .backbg .agent-sec .agent-one
    {
        background-color: #fff;
        width: 100%;
        float: left;
        margin-bottom: 15px;
    }
    .agent .backbg .agent-sec .agent-one .agent-info
    {
        padding:45px 10px 0px;
    }
    .agent .backbg .agent-sec .agent-one .agent-img
    {
        padding: 0px;
    }
    .agent .backbg .agent-sec .agent-one .agent-info .agent-social li
    {
        display: inline-block;
        padding:0px 10px 0px 0px;
        margin-bottom: 10px;
    }

    .agent .backbg .agent-sec .agent-one .agent-info .agent-social li a
    {
        color: #F84B4A;
        font-size: 20px;
    }
    /**work section**/
    .works
    {
        width: 100%;
        float: left;
        padding: 80px 0px 0px 0px;
    }
    #Container .mix{
        display: none;
    }
    .works .work-sec .fil-btn
    {
        margin-bottom: 36px;
        width: 100%;
        float: left;
    }
    .works .work-sec .wrk-title
    {
        background-color: #FFF;
        width: 24%;
        margin-right: 1.3%;
        padding: 15px;
        border: 1px solid #F84B4A;
        color: #fff;
        cursor: pointer;
        background-color: #F84B4A;
    }
    .works .work-sec .lst-cld
    {
        margin-right: 0px;
    }
    .works .work-sec .active {
        background-color: transparent;
        color: rgb(248, 75, 74);
        border-color: #F84B4A;
    }
    .works .work-sec img
    {
        width: 100%;
        position: relative;
    }
    .works .work-sec .filimg
    {
        margin-bottom: 30px;
        cursor: pointer;
    }
    .works .work-sec .filimg .img-hover
    {
        position: absolute;
        bottom: 0px;
        background: rgba(248, 75, 74, 0.67) none repeat scroll 0% 0%;;
        left: 15px;
        right: 15px;
        display: none;
    }
    .works .work-sec .filimg:hover .img-hover
    {
        display: block;
    }
    .works .work-sec .filimg .img-hover h3
    {
        color: #FFF;
        font-size: 16px;
        padding: 15px;
    }



    /**client section**/
    .client
    {
        width: 100%;
        float: left;
    }
    .client blockquote
    {
        border: 0px none;
        padding: 0px 0px 0px 25px;
        margin: 0px;
        border-left: 5px solid rgba(85, 85, 85, 0.3);
    }
    .client blockquote p
    {
        padding: 0px !important;
        font-size: 18px;
        font-style: italic;
        letter-spacing: 0px;
        font-weight: normal;
        color: rgba(85, 85, 85, 0.56);
        text-transform: none;
    }
    .client blockquote .name
    {
        margin: 0px;
    }
    .client blockquote .degi
    {
        margin: 0px;
    }
    .txt-comma
    {
        color: #555;
        font-size: 25px;
    }
    .name
    {
        padding: 0px;
        margin: 0px;
    }
    .degi
    {
        color: #BF9E14;
        font-weight: 600;
        padding: 0px;
        margin: 0px;
    }
    .client .cli-info
    {
        width: 100%;
        float: left;
        padding: 64px 0px 0px 0px;
    }

    /**news section**/
    .news
    {
        width: 100%;
        float: left;
        background-color: #fff;
        padding: 80px 0px 53px 0px;

    }
    .news .news-sec
    {
        width: 100%;
        float: left;
    }
    .news .news-sec .news-colm .news-itm
    {
        background-color: #F84B4A;
        padding: 10px;
        color: #fff;
        margin-bottom: 30px;
        cursor: pointer;
    }
    .news .news-sec .news-colm .news-itm h4
    {
        color: #FFF;
        font-weight: 600;
        padding-bottom: 15px;
        font-size: 20px;
    }
    .news .news-sec .news-colm .news-itm p
    {
        color: #FFF;
        font-size: 13px;
        line-height: 22px;
    }
    .news .news-sec .news-colm .news-itm a
    {
        display: inline-block;
        color: rgb(248, 75, 74);
        margin: 10px 0px;
        text-decoration: none;
        border-radius: 1px;
        background-color: #FFF;
        padding: 2px 10px;
        font-size: 14px;

    }
    .news-line
    {
        background: rgb(56, 60, 75);
        width: 30px;
        margin: 17px 0px;
        border-width: 3px;
        height: 2px;
    }

    /**contact section**/
    .contact
    {
        width: 100%;
        float: left;
        margin: 0px 0px 80px 0px;
    }
    .contact .contact-info
    {
        background-color: #EBEBEB;
        width: 100%;
        float: left;
        padding: 30px 25px 30px 15px;
        border-radius: 5px;
    }
    .contact .contact-info .cont-txt h3
    {
        color: #0f0f0f;
        font-size: 32px;
        margin-bottom: 10px;
    }
    .contact .contact-info .cont-btn
    {
        margin-top: 16px;
        background-color: rgba(79, 88, 125, 0.35);
        padding: 20px 50px;
        color: #FFF;
        font-size: 22px;
        display: inline-block;
        transition: all 0.5s ease-in 0s;
    }
    .contact .contact-info .cont-btn:hover
    {
        background-color: rgba(79, 88, 125, 0.49);
        transition: all 0.5s ease-in 0s;
    }

    /**appoint sec**/
    .appoin-sec
    {
        width: 100%;
        float: left;
        background-color: #2C2F3C;
        padding: 80px 0px;
    }
    .appoin-sec .footer-sec h2
    {
        font-size: 28px;
        color: #fff;
        font-weight: 600;
        padding: 15px 0px;
    }
    .appoin-sec .footer-sec p
    {
        color: #fff;
        font-size: 18px;
        padding: 15px 0px;
    }
    .appoin-sec .footer-sec a
    {
        color: #FFF;
        background-color: rgba(79, 88, 125, 0.49);
        display: inline-block;
        padding: 19px 26px;
        font-size: 18px;
        transition: all 0.5s ease-in 0s;
    }
    .appoin-sec .footer-sec a:hover
    {
        background-color: rgba(79, 88, 125, 0.25);
        transition: all 0.5s ease-in 0s;
    }
    .appoin-sec .footer-sec a i
    {
        padding-right: 10px;
    }
    /**footer sec**/
    .footer
    {
        width: 100%;
        float: left;
        padding: 80px 0px;
    }
    .footer .footer-social li
    {
        display: inline-block;
    }
    .footer .footer-social li a i
    {
        color: #C1C0C0;
        font-size: 24px;
        display: inline-block;
        width: 70px;
        height: 70px;
        line-height: 70px;
        background-color: #E9E8E8;
        border-radius: 3px;
        transition: all 0.8s ease-in 0s;
    }
    #red:hover
    {
        background-color: #D1432F;
        color: #fff;
        transition: all 0.8s ease-in 0s;
    }
    #blue:hover
    {
        background-color: #4161A2;
        color: #fff;
        transition: all 0.8s ease-in 0s;
    }
    #light-blue:hover
    {
        background-color: #09AEEC;
        color: #fff;
        transition: all 0.8s ease-in 0s;
    }
    .footer-line
    {
        width: 100%;
        float: left;
        padding-bottom: 80px;
    }
    .footer-line p
    {
        font-weight: 300;
        color: #AAA;
        font-size: 12px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    /** media queries**/
    @media (min-width: 350px) and (max-width: 768px) {
        .agent .backbg .agent-sec .agent-one .agent-img img
        {
            width: 100%;

        }
        .main-header .banner-text {
            padding-top: 150px;
        }
        .banner-info h2 {
            font-size: 30px;
            padding-bottom: 100px;
        }
        .heading h3 {
            font-size: 20px;
            padding-bottom: 15px;
        }
        .contact .contact-info .cont-btn {
            padding: 10px 30px;
            float: left;
        }
        .appoin-sec .footer-sec p {
            font-size: 14px;
        }
        .appoin-sec .footer-sec h2 {
            font-size: 18px;
        }
        .appoin-sec .footer-sec a {
            font-size: 14px;
        }
        .footer-line p {
            font-size: 16px;
        }
        .works .work-sec .wrk-title  {

            font-size: 12px;
            padding: 7px;

        }
        .contact .contact-info .cont-txt h3
        {
            font-size: 18px;
        }
        .contact .contact-info .cont-txt p
        {
            font-size: 14px;
        }
        .agent .agent-sec .agent-one .agent-info .agent-social li a i
        {
            font-size: 18px;
        }
    }
    @media (min-width: 100px) and (max-width: 350px) {
        .agent .backbg .agent-sec .agent-one .agent-img img
        {
            width: 100%;

        }
        .main-header .banner-text {
            padding-top: 150px;
        }
        .banner-info h2 {
            font-size: 30px;
            padding-bottom: 100px;
        }
        .heading h3 {
            font-size: 20px;
            padding-bottom: 15px;
        }
        .contact .contact-info .cont-btn {
            padding: 10px 30px;
            float: left;
        }
        .appoin-sec .footer-sec p {
            font-size: 14px;
        }
        .appoin-sec .footer-sec h2 {
            font-size: 18px;
        }
        .appoin-sec .footer-sec a {
            font-size: 14px;
        }
        .footer-line p {
            font-size: 16px;
        }
        .works .work-sec .wrk-title  {

            font-size: 12px;
            padding: 7px;

        }
        .contact .contact-info .cont-txt h3
        {
            font-size: 18px;
        }
        .contact .contact-info .cont-txt p
        {
            font-size: 14px;
        }

    }
</style>
</body>
</html>
