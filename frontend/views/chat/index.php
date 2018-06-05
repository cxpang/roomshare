<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use janisto\timepicker\TimePicker;
use common\models\Room;
use common\models\City;
use common\models\Area;
$this->title = '私聊用户';
?>
<div data-role="page" style="margin-top: 100px">
    <div data-role="content" class="container" role="main">
        <div id="chat-div" class="col-md-8" style="border: 1px solid #ccc;overflow: auto;height: 600px">
        <ul id="chat-content" class="content-reply-box mg10">

            <li class="even">
                <a class="user" href="#"><img class="img-responsive avatar_" src="<?=$to_user['user_picture']?>" alt=""><span class="user-name"><?=$to_user['username']?></span></a>
                <div class="reply-content-box">
                    <span class="reply-time"><?=date('Y-m-d H:i:s',time())?></span>
                    <div class="reply-content pr">
                        <?php if(!$to_user['message']){?>
                        <span class="arrow">&nbsp;</span>
                        您好，我是房主<?=$to_user['username']?>，很高兴为您服务，请问有什么可以帮您？
                        <?php } ?>
                        <?php if($to_user['message']){?>
                            <span class="arrow">&nbsp;</span>
                            <?=$to_user['message']?>
                        <?php } ?>
                    </div>
                </div>
            </li>

        </ul>


        </div>
        <div class="col-md-8" style="margin-bottom: 50px;border-left: 1px solid #ccc;border-right:1px solid #ccc;border-bottom: 1px solid #ccc ">
            <label for="chatmessage"></label>
            <textarea required id="input-message" class="form-control" rows="3"></textarea>
            <button onclick="sendmessage();" style="float: right;margin-top: 10px" class="btn btn-primary">发送</button>
        </div>
    </div>
</div>
<style>
    body{background-color:#f2f2f2;font-family:'Microsoft Yahei','Arial';}
    ul{padding:0;margin:0;}
    li{list-style:none;}
    .header{padding:1em 0;width:100%;display:inline-block;}
    .header a,.ui-link{color:#666;}
    .header a:hover{text-decoration:none;}
    .header .glyphicon{font-size:1.4em;cursor:pointer;}
    .user_box{width:100%;padding:2.2em 0;}
    .avatar{border:2px solid #999;border-radius:50%;padding:.8em;}
    .username{display:inline-block;width:100%;padding:10px 0 20px;font-size:1.2em;color:#999;border-bottom:1px solid #e6e6e6;}
    .menu{border-bottom:1px solid #e6e6e6;box-shadow:0 0 1px #fff;}
    .menu a{color:#333;padding:1em 0;font-size:1em;display:block;}
    .menu a:hover{text-decoration:none;background-color:#ffffff;}
    .ui-loader h1{display:none;}
    .avatar_{
        border-radius:50%;
        margin-top:15px;
        opacity:1;
        height: 45px;
        width: 45px;
        filter:alpha(opacity=100);
        transition:all 0.3s ease-in 0s;
        -moz-transition:all 0.3s ease-in 0s;
        -webkit-transition:all 0.3s ease-in 0s;
        -o-transition:all 0.3s ease-in 0s;
    }
    .user:hover .avatar_{border-radius:0;transition:all 0.3s ease-in 0s;-moz-transition:all 0.3s ease-in 0s;-webkit-transition:all 0.3s ease-in 0s;-o-transition:all 0.3s ease-in 0s;opacity:.8;filter:alpha(opacity=80);}
    .content-reply-box{width:100%;overflow:hidden;}
    .content-reply-box li{width:100%;overflow:hidden;margin-bottom:2em;}
    .content-reply-box li.odd .user{float:left;margin-right:10px;}
    .content-reply-box li.even .user{float:right;margin-left:10px;}
    .content-reply-box li.odd .reply-content-box{margin-left:60px;}
    .content-reply-box li.even .reply-content-box{margin-right:60px;}
    .user-name{color:#999;margin-top:5px;display:block;text-align:center;width:50px;white-space:nowrap;text-overflow:ellipsis;-o-text-overflow:ellipsis;overflow: hidden;}
    .reply-time{color:#e1912d;font-size:.85em;display:inline-block;width:100%;}
    .content-reply-box li.odd .reply-time{text-align:left;}
    .content-reply-box li.even .reply-time{text-align:right;}
    .reply-content{border:1px solid #fcfcfc;padding:.6em;background-color:#fcfcfc;border-radius:4px;box-shadow:0 0 5px #ccc;}
    .content-reply-box li.odd .arrow{width:0;height:0;line-height:0;font-size:0;border-color:transparent #fff transparent transparent;border-width:6px;border-style:dashed solid dashed dashed;display:block;position:absolute;top:8px;left:-12px;z-index:999;}
    .content-reply-box li.even .arrow{width:0;height:0;line-height:0;font-size:0;border-color:transparent transparent transparent #fff;border-width:6px;border-style:dashed dashed dashed solid;display:block;position:absolute;top:8px;right:-12px;z-index:999;}
    .operating{border-top:1px solid #ccc;}
    .operating li{border-right:1px solid #ccc;}
    .operating a{padding:0.85em 0;display:inline-block;width:100%;}
    .pr{position:relative;}
    .oh{overflow:hidden;}
    .mg10 {margin:10px 0;}
    .linear-g{background: -moz-linear-gradient(top, #fdfdfd, #f6f6f6);background: -webkit-gradient(linear,top,from(#fdfdfd),to(#f6f6f6));background: -webkit-linear-gradient(top, #fdfdfd, #f6f6f6);background: -o-linear-gradient(top, #fdfdfd, #f6f6f6);box-shadow:0 0 5px #ccc;}
</style>
<script>
    var socket = null; //初始为null
    var touser=null;
    var isLogin = false; //是否登录到服务器上

    window.onload = function(){
        var userid="<?=Yii::$app->user->identity->getId()?>";
        socket = new WebSocket("ws://120.24.97.50:8484");
        socket.onopen = function() {
            socket.send('login:' + userid);
        };
        socket.onmessage=function (e) {
            var getMsg = e.data;
            if(/^notice:success$/.test(getMsg)) { //服务器验证通过
                isLogin = true;
            }
            else if(/^msg:/.test(getMsg)) { //代表是普通消息
                console.log(getMsg);
                var now=gettime();
                var i="<li class='even'> <a class='user' href='#'>";
                i+=" <img class='img-responsive avatar_' src='<?=$to_user['user_picture']?>' alt=''>";
                i+="<span class='user-name'><?=$to_user['username']?></span></a>";
                i+="<div class='reply-content-box'>";
                i+=" <span class='reply-time'>"+now+"</span>";
                i+="<div class='reply-content pr'>";
                i+="<span class='arrow'>&nbsp;</span>";
                i+=getMsg.replace('msg:','');
                i+="</div></div></li>";


                $("#chat-content").append(i);
            }
            else if(/^users:/.test(getMsg)){ //显示当前已登录用户
                console.log(getMsg);


                getMsg = getMsg.replace('users:','');
                getMsg= eval('('+getMsg+')'); //转json
                findkey(getMsg);


            }

        }
        socket.onclose = function(){
            isLogin = false;
        }
    }







    function findkey(obj) {
        $.each(obj, function(key, val) {
            if(val=="<?=$to_user['id'] ?>"){
                touser= key;
            }
        });
    }


    function sendmessage() {
        message=$("#input-message").val();
        if($.trim(message).length==0){
            alert("发送消息不能为空");
            $("#input-message").focus();
        }
        else if(!touser){
            //    保存离线消息到数据库中
            var formdata=new FormData();
            formdata.append('toid',<?=$to_user['id']?>);
            formdata.append('message',message);
            $.ajax(
                {
                    url:'<?=Url::to(['chat/chatindexsave'])?>',
                    type:'POST',
                    cache:false,
                    data:formdata,

                    processData:false,
                    contentType:false,
                    success:function (data) {
                        alert("用户离线，我们将在用户上线时通知用户");
                        $("#input-message").val("");
                    }
                }
            )
        }
        else{
            socket.send('chat:<'+touser+'>:'+message);
            var now=gettime();
            var i="<li class='odd'> <a class='user' href='#'>";
            i+=" <img class='img-responsive avatar_' src='<?=\common\models\UserInfo::GetUserImage(Yii::$app->user->getId())?>' alt=''>";
            i+="<span class='user-name'><?=Yii::$app->user->identity->username?></span></a>";
            i+="<div class='reply-content-box'>";
            i+=" <span class='reply-time'>"+now+"</span>";
            i+="<div class='reply-content pr'>";
            i+="<span class='arrow'>&nbsp;</span>";
            i+=message;
            i+="</div></div></li>";
            $("#chat-content").append(i);
            $("#chat-div").scrollTop($("#chat-div")[0].scrollHeight);
            $("#input-message").val("");
            $("#input-message").focus();
        }
    }
    //获取当前时间
    function gettime() {
        var myDate = new Date();
        var year=myDate.getFullYear();
        var month=myDate.getMonth()+1;
        var date=myDate.getDate();
        var h=myDate.getHours();
        var m=myDate.getMinutes();
        var s=myDate.getSeconds();

        var now=year+'-'+month+"-"+date+" "+h+':'+m+":"+s;
        return now;
    }


</script>