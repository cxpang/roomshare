<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\RentStory;
use common\models\UserInfo;
use common\services\ChangeService;
$this->title="租房故事";
?>
<div class="container body-back">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <ul class="breadcrumb">
                <li>
                    <a href="<?=Url::to(['site/index'])?>">首页</a>
                </li>
                <li>
                    <a href="<?=Url::to(['rent-story/index'])?>">租房故事</a>
                </li>
                <li class="active">
                    <?=$data['story_name']?>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="thumbnail">
                        <div>
                            <img alt="300x200" class="img-circle" style="height: 80px;width: 80px" src="<?=$data['user_picture']?>" />
                            <span class="glyphicon glyphicon-user">:<?=$data['username']?></span>
                            <br><span class="glyphicon glyphicon-thumbs-up"><span style="font-size: 20px">:<?=ChangeService::actionChangeExpe($data['user_expe'])?></span></span>

                            <span style="float: right;margin-top: 35px;" class="glyphicon glyphicon-time">:<?=date('Y-m-d H:i',$data['create_at'])?></span>
                        </div>
                        <hr />
                        <div class="caption">
                            <div class="col-md-12">
                                <?php if($data['is_star']==1){?>
                                    <span style="color: red" class="glyphicon glyphicon-star">星标故事</span>

                                <?php  }?>
                            </div>
                            <h3 style="text-align: center">
                                <?=$data['story_name']?>
                            </h3>
                            <textarea style="width: 100%;height: 1000px;border:0;font-size: 20px" readonly>
                                <?=$data['story_text']?>
                             </textarea>

                        </div>
                        <hr />
                        <div style="text-align: center">
                            <span id="support<?=$_GET['story_id']?>" onclick="addsuport(<?=$_GET['story_id']?>)"  style="margin-right: 50px;cursor: pointer;" class="glyphicon glyphicon-thumbs-up">支持</span>

                            <span id="love<?=$_GET['story_id']?>" onclick="addlove(<?=$_GET['story_id']?>)" style="cursor: pointer;" class="glyphicon glyphicon-heart-empty">喜欢</span>
                        </div>
                        <hr />
                        <div style="text-align: center">
                            <?php if($last){
                                echo "<a href=".Url::to(['rent-story/detail','story_id'=>$last['id']]).">上一篇:".$last['story_name']."</a>"."<br /><br />";
                            } ?>
                            <?php if($next){
                                echo "<a href=".Url::to(['rent-story/detail','story_id'=>$next['id']]).">下一篇:".$next['story_name']."</a>";
                            } ?>
                        </div>
                        <hr />
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function addsuport(story_id) {
        var formdata=new FormData();
        formdata.append('story_id',story_id);
        $.ajax({
            url:'<?=Url::to(['storyhelp/addsupport']) ?>',
            type:'POST',
            cache:false,
            data:formdata,
            dataType:'json',
            processData:false,
            contentType:false,
            success:function (data) {
                if(data){
                     $("#support"+story_id).css('color','red');
                }

            }
        })
    }
    function addlove(story_id) {
        var formdata=new FormData();
        formdata.append('story_id',story_id);
        $.ajax({
            url:'<?=Url::to(['storyhelp/addlove']) ?>',
            type:'POST',
            cache:false,
            data:formdata,
            dataType:'json',
            processData:false,
            contentType:false,
            success:function (data) {
                if(data){
                    $("#love"+story_id).css('color','red');
                }

            }
        })
    }
</script>

<style>
    body{
        background: url("/roomshare/uploads/picjumbo-bg5.jpg") 0% 0% / 100% no-repeat fixed;
        no-repeat fixed;
        background-position: center;
        background-size: cover;
        width: 100%;

    }
    .body-back{
        margin-top: 50px;
        margin-bottom: 100px;
    }

</style>

