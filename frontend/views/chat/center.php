<?php
use common\models\UserInfo;
use common\models\User;
use common\models\Chatpoint;
$this->title = '私聊用户';
?>
<div data-role="page" style="margin-top: 100px">
    <div data-role="content" class="container" role="main">
        <div id="chat-div" class="col-md-8" style="border: 1px solid #ccc;overflow: auto;height: 600px">



        </div>
        <div class="col-md-4" style="overflow: auto;height: 600px;border-bottom: 1px solid #ccc;border-top: 1px solid #ccc;border-right: 1px solid #ccc">


            <?php if(isset($to_chats)){
                   foreach ($to_chats as $row){
                ?>
            <div onclick="changechat(<?=$row['fromid']?>)" style="border-bottom: 1px solid #ccc;cursor: pointer;">
                <span>
                    <img class="img-circle  avatar_"  src="<?=UserInfo::GetUserImage($row['fromid'])?>">
                    <strong><?=User::GetUserName($row['fromid'])?></strong>
                </span>
                <span style="margin-left:20px"><?=Chatpoint::SubString($row['message'])?></span>
                <span style="float: right;margin-top: 20px;color: #f0ad4e"><?=date('Y-m-d H:i:s',$row['updated_at'])?></span>
            </div>    


            <?php }}?>
            <?php if(isset($from_chats)){
                foreach ($from_chats as $row){
                    ?>
                    <div onclick="changechat(<?=$row['toid']?>)"   style="border-bottom: 1px solid #ccc;cursor: pointer;">
                <span>
                    <img class="img-circle  avatar_"  src="<?=UserInfo::GetUserImage($row['toid'])?>">
                    <strong><?=User::GetUserName($row['toid'])?></strong>
                </span>
                        <span style="margin-left:20px"><?=Chatpoint::SubString($row['message'])?></span>
                        <span style="float: right;margin-top: 20px;color: #f0ad4e"><?=date('Y-m-d H:i:s',$row['updated_at'])?></span>
                    </div>


                <?php }}?>






        </div>
        <div class="col-md-8" style="margin-bottom: 50px;border-left: 1px solid #ccc;border-right:1px solid #ccc;border-bottom: 1px solid #ccc ">
            <label for="chatmessage"></label>
            <textarea required id="input-message" class="form-control" rows="3"></textarea>
            <button onclick="sendmessage();" style="float: right;margin-top: 10px" class="btn btn-primary">发送</button>
        </div>
    </div>
</div>
<style>
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
</style>
<script>
    function changechat(user_id) {

        alert(user_id);
    }
</script>
