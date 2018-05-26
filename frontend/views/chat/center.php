<?php
use common\models\UserInfo;
use common\models\User;
use common\models\Chatpoint;
use yii\helpers\Url;
$this->title = '私聊用户';

?>
<div data-role="page" style="margin-top: 100px">
    <div data-role="content" class="container" role="main">
        <div id="chat-div-main" class="col-md-8" style="border: 1px solid #ccc;overflow: auto;height: 600px">
            <span id="chat-tips" type="button" class="btn btn-warning btn-block disabled btn-lg">用户聊天列表</span>



            <?php if(isset($to_chats)){
            foreach ($to_chats as $row){
            ?>

            <div id="chat-div<?=$row['fromid']?>" class="col-md-12 yincang" style="border: 1px solid #ccc;overflow: auto;height: 550px">

                <ul id="chat-content<?=$row['fromid']?>" class="content-reply-box mg10">

                    <li class="even">
                        <a class="user" href="#"><img class="img-responsive avatar_" src="<?=UserInfo::GetUserImage($row['fromid'])?>" alt=""><span class="user-name"><?=User::GetUserName($row['fromid'])?></span></a>
                        <div class="reply-content-box">
                            <span class="reply-time"><?=date('Y-m-d H:i:s',$row['updated_at'])?></span>
                            <div class="reply-content pr">
                                <span class="arrow">&nbsp;</span>
                                <?=$row['message']?>
                            </div>
                        </div>
                    </li>

                </ul>

            </div>

            <?php }}?>



            <?php if(isset($from_chats)){
                foreach ($from_chats as $row){
                    ?>
                    <div id="chat-div<?=$row['toid']?>" class="col-md-12 yincang" style="border: 1px solid #ccc;overflow: auto;height: 550px">
                        <ul id="chat-content<?=$row['toid']?>" class="content-reply-box mg10">
                        <li class="odd">
                            <a class="user" href="#"><img class="img-responsive avatar_" src="<?=UserInfo::GetUserImage($row['fromid'])?>" alt=""><span class="user-name"><?=User::GetUserName($row['fromid'])?></span></a>
                            <div class="reply-content-box">
                                <span class="reply-time"><?=date('Y-m-d H:i:s',$row['updated_at'])?></span>
                                <div class="reply-content pr">
                                    <span class="arrow">&nbsp;</span>
                                    <?=$row['message']?>
                                </div>
                            </div>
                        </li>
                            <ul>

                    </div>

                <?php }}?>


        </div>
        <div class="col-md-4" style="overflow: auto;height: 600px;border-bottom: 1px solid #ccc;border-top: 1px solid #ccc;border-right: 1px solid #ccc">

            <ul class="yy_ul">
            <?php if(isset($to_chats)){
                   foreach ($to_chats as $row){
                ?>
            <li id="chatlist<?=$row['fromid']?>" onclick="changechat(<?=$row['id']?>,<?=$row['fromid']?>,'<?=User::GetUserName($row["fromid"])?>','<?=UserInfo::GetUserImage($row["fromid"])?>')" style="border-bottom: 1px solid #ccc;cursor: pointer;">
                <span>
                    <img class="img-circle  avatar_"  src="<?=UserInfo::GetUserImage($row['fromid'])?>">
                    <strong><?=User::GetUserName($row['fromid'])?></strong>
                </span>
                <span style="margin-left:20px"><?=Chatpoint::SubString($row['message'])?></span>
                <span style="float: right;margin-top: 20px;color: #f0ad4e"><?=date('Y-m-d H:i:s',$row['updated_at'])?></span>
            </li>


            <?php }}?>
            <?php if(isset($from_chats)){
                foreach ($from_chats as $row){
                    ?>
                    <li id="chatlist<?=$row['toid']?>" onclick="changechat(<?=$row['id']?>,<?=$row['toid']?>,'<?=User::GetUserName($row["toid"])?>','<?=UserInfo::GetUserImage($row["toid"])?>')"   style="border-bottom: 1px solid #ccc;cursor: pointer;">
                <span>
                    <img class="img-circle  avatar_"  src="<?=UserInfo::GetUserImage($row['toid'])?>">
                    <strong><?=User::GetUserName($row['toid'])?></strong>
                </span>
                        <span style="margin-left:20px"><?=Chatpoint::SubString($row['message'])?></span>
                        <span style="float: right;margin-top: 20px;color: #f0ad4e"><?=date('Y-m-d H:i:s',$row['updated_at'])?></span>
                    </li>


                <?php }}?>
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
    .yincang{
        display: none;
    }
    li{
        list-style-type:none;
    }
    ul{
        margin-left: -50px;
        margin-right: -10px;
    }
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
    .li_yysy{
        background:#f0ad4e;
    }
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
    var to_user_id=null;
    var to_user_name=null;
    var to_user_picture=null;
    var to_chat_id=null;
    window.onload=function(){
        $(".yy_ul li").hover(function(){
                $(this).addClass('li_yysy');


            },function(){
                $(this).removeClass('li_yysy');
            }
        );


    };


    // function findkey(obj) {
    //     $.each(obj, function(key, val) {
    //         if(val=="to_user_id"){
    //             touser= key;
    //             console.log(touser);
    //         }
    //     });
    // }

    function changechat(chatid,user_id,username,user_picture) {
        var content="正在与"+username+"在线聊天中";
        $("#chat-tips").html(content);
        $("#chat-div-main").children('div').addClass('yincang');
        $("#chat-div"+user_id).removeClass('yincang');
        to_user_id=user_id;
        to_user_name=username;
        to_user_picture=user_picture;
        to_chat_id=chatid;

        chating();

    }
    //聊天辅助函数
    function chating() {
        var userid="<?=Yii::$app->user->identity->getId()?>";
        socket = new WebSocket("ws://120.79.130.178:8484");
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
                i+=" <img class='img-responsive avatar_' src='"+to_user_picture+"' alt=''>";
                i+="<span class='user-name'>"+to_user_name+"</span></a>";
                i+="<div class='reply-content-box'>";
                i+=" <span class='reply-time'>"+now+"</span>";
                i+="<div class='reply-content pr'>";
                i+="<span class='arrow'>&nbsp;</span>";
                i+=getMsg.replace('msg:','');
                i+="</div></div></li>";


                $("#chat-content"+to_user_id).append(i);
            }
            else if(/^users:/.test(getMsg)){ //显示当前已登录用户



                getMsg = getMsg.replace('users:','');
                getMsg= eval('('+getMsg+')'); //转json
                // findkey(getMsg);
                touser=null;
                $.each(getMsg, function(key, val) {
                    if(val==to_user_id){
                        touser= key;
                    }

                });

            }

        }
        socket.onclose = function(){
            isLogin = false;
        }
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
            formdata.append('to_chat_id',to_chat_id);
            formdata.append('message',message);
            $.ajax(
                {
                    url:'<?=Url::to(['chat/chatcentersave'])?>',
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
            $("#chat-content"+to_user_id).append(i);
            $("#chat-div"+to_user_id).scrollTop($("#chat-div"+to_user_id)[0].scrollHeight);
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
