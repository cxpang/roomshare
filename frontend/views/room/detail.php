<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use janisto\timepicker\TimePicker;
use common\models\Room;
use common\models\UserInfo;
use common\models\User;
use common\models\City;
use common\models\Area;
use common\services\ChangeService;
$this->title = '合租详细信息';
$roomimagestring=$data['room_images'];
$roomimagearray=explode(",",$roomimagestring);
?>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=oXWXYAe769VmAFVPxmGmrdRHb9CPgPzx"></script>
<script type="text/javascript" src="js/RoomDetail.js?v=<?=time()?>"></script>
<div class="container" style="margin-bottom: 100px;margin-top: 100px">
    <div class="row clearfix">
        <div class="col-md-8 column">
            <ul class="breadcrumb">
                <li>
                    <a href="<?=Url::to(['site/index'])?>">首页</a>
                </li>
                <li>
                    <a href="<?=Url::to(['room/index','room_city'=>0])?>">租房</a>
                </li>
                <li class="active">
                    <?=$data['room_name']?>
                </li>
            </ul>
            <div class="carousel slide" id="carousel-947655">
                <ol class="carousel-indicators">
                    <li class="active" data-slide-to="0" data-target="#carousel-947655">
                    </li>
                    <li data-slide-to="1" data-target="#carousel-947655">
                    </li>
                    <li data-slide-to="2" data-target="#carousel-947655">
                    </li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img alt="" src="/roomshare/uploads/<?=$roomimagearray[0]?>" />
                    </div>
                    <div class="item">
                        <img alt="" src="/roomshare/uploads/<?=$roomimagearray[1]?>" />
                    </div>
                    <div class="item">
                        <img alt="" src="/roomshare/uploads/<?=$roomimagearray[2]?>" />
                    </div>
                </div> <a class="left carousel-control" href="#carousel-947655" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-947655" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
                <img style="margin-top: 50px" src="/roomshare/uploads/fangwupeizhi.jpg">
                <img style="width: 750px" src="/roomshare/uploads/fangwupeizhi2.jpg">

            <div id="baidu-map">

            </div>
            <div class="tabbable" id="tabs-810804" style="margin-top: 50px">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#panel-304156" data-toggle="tab"><button class="btn btn-primary">评论信息<span class="badge pull-right"><?=$data['comment_count']?></span></button> </a>


                    </li>
                    <li>
                        <a href="#panel-594129" data-toggle="tab" ><button class="btn btn-success">发表评论</button></a>
                    </li>
                </ul>
                <div class="tab-content">


<!--                    评论信息-->
                    <div class="tab-pane active" id="panel-304156" >
                        <?php
                        foreach (Yii::$app->session->getAllFlashes() as $key=>$message){
                            echo '<div style="margin-top:50px" class="alert alert-' . $key . '">' . $message . "</div>\n";
                        }
                        ?>
                        <?php foreach ($data['comment'] as $row){?>
                        <div class="col-md-12" style="margin-top: 20px;border-top: solid 1px #ccc;">

                                <div class="col-md-1" style="margin-top: 10px">
                                    <img class="comment-image img-circle"   src="<?=UserInfo::GetUserImage($row['user_id'])?>">
                                </div>
                                <div class="col-md-11" style="margin-top: 15px">
                                    <div style="font-size: 20px;color:#2d64b3"><?=User::GetUserName($row['user_id'])?></div>
                                    <div style="float: right;font-size: 20px;margin-top: -30px;">
                                        <button data-loading-text="*****" id="btn<?=$row['comments_id']?>" style="color: #2d64b3" class="btn btn-default" onclick="showcommentres(<?=$row['comments_id']?>)"><span class="glyphicon glyphicon-comment"></span>&nbsp;<?=$row['answer_count']?></button>
                                        <br />
                                        <button style="color: #2d64b3;width: 53px;margin-top: 5px;" onclick="addcomres(<?=$row['user_id']?>,'<?=User::GetUserName($row["user_id"])?>',<?=$row['comments_id']?>)" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span></button>

                                    </div>
                                    <div><?=date('Y-m-d H:i:s',$row['created_at'])?></div>

                                </div>
                                <div class="col-md-12" id="<?=$row['comments_id']?>" style="margin-top: 30px;color: #484848;font-size: 18px;margin-bottom: 10px">
                                    <?=$row['comments_content']?>
                                </div>
                                <div class="col-md-12" id="res-form<?=$row['comments_id']?>" style="display: none">
                                    <?php $form = ActiveForm::begin(['method' => "post",'action'=>Url::to(['room/addcommres']),'options' => ['style' => 'margin-top: 10px;margin-bottom:10px;'] ]); ?>

                                    <div class="col-md-12 form-group" style="margin-top: 50px;border: solid 1px #ccc;">
                                        <input type="text" name="roomid" class="form-control" value="<?=$data['room_id']?>" style="display: none">

                                        <input type="text" id="res_at_user_id<?=$row['comments_id']?>" style="display: none;" name="at_user_id" class="form-control">
                                        <input type="text" id="res_comments_id<?=$row['comments_id']?>" style="display: none;" name="comments_id" class="form-control">
                                        <div class="col-md-3" style="margin-top: 23px;font-size: 18px;" id="res_comments_con<?=$row['comments_id']?>"></div>
                                        <div class="col-md-9"  style="margin-top: 20px;">
                                            <input type="text"  name="res_comments_con" class="form-control">
                                        </div>
                                        <div class="col-md-2" style="margin-top: 20px;margin-bottom: 20px;">
                                            <input type="submit" class="btn btn-primary ">
                                        </div>
                                        <div class="col-md-2" style="margin-top: 20px;margin-bottom: 20px;">
                                            <input type="button" onclick="closediv(<?=$row['comments_id']?>);" value="关闭" class="btn btn-danger">
                                        </div>

                                    </div>
                                    <?php $form = ActiveForm::end();  ?>
                                </div>

                        </div>
                        <?php }?>



                    </div>
<!--                    添加评论-->
                    <div class="tab-pane" id="panel-594129">
                        <?php
                           if(Yii::$app->user->isGuest) {
                               ?>
                               <div class="col-md-5" style="margin-top: 50px">
                                   <span class="alert alert-info">您还没有登陆,请点击右侧登陆按钮</span>
                               </div>
                               <div class="col-md-3"style="margin-top: 45px">
                                   <span><a class="btn btn-primary" href="<?=Url::to(['site/login'])?>">登陆</a></span>

                               </div>
                               <?php
                           }
                        ?>
                        <?php if(!Yii::$app->user->isGuest){?>
                        <?php
                        foreach (Yii::$app->session->getAllFlashes() as $key=>$message){
                            echo '<div style="margin-top:50px" class="alert alert-' . $key . '">' . $message . "</div>\n";
                        }
                        ?>
                        <?php $form = ActiveForm::begin(['method' => "post",'action'=>Url::to(['room/addcomment']),'options' => ['style' => 'margin-top: 10px;margin-bottom:10px;'] ]); ?>

                        <div class="col-md-12 form-group" style="margin-top: 50px;border: solid 1px #ccc;">
                            <input type="text" name="roomid" class="form-control" value="<?=$data['room_id']?>" style="display: none">
                            <div class="col-md-2" style="font-size: 18px;margin-top: 24px;">评论内容:</div>
                            <div class="col-md-10" style="margin-top: 20px;">
                                <input type="text" name="roomcontent" class="form-control">
                            </div>
                            <div class="col-md-2" style="margin-top: 20px;margin-bottom: 20px;">
                                <input type="submit" class="btn btn-primary ">
                            </div>
                            <div class="col-md-2" style="margin-top: 20px;margin-bottom: 20px;">
                                <input type="reset" class="btn btn-danger">
                            </div>

                        </div>
                        <?php $form = ActiveForm::end(); } ?>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 column">
            <h3 class="text-center text-success">
                <?=$data['room_name']?>
            </h3>
            <span class="ellipsis">
                <span class="glyphicon glyphicon-map-marker">:</span><?=$data['room_address']?>
            </span>
            <span class="price">
               ￥:<?=$data['room_price']?>/月
            </span>
            <br />
            <span class="glyphicon glyphicon-tags">:
            <span class="tag">
                 <?=$data['room_content']?></span>
            </span>
            <ul class="detail_room">
                <li><b></b>类型:
                    <span class="icons"><?=Room::$ROOM_TYPE[$data['room_type']]?></span><span class="icons">月</span>
                </li>
                <li><b></b>详细信息:<?=$data['room_detail']?></li>
                <strong><li><b></b>所属地区:<?=City::findCity($data['room_city'])."|".Area::findarea($data['room_area'])?></li></strong>
                <strong> <li><b></b>发布时间:<?=date('Y-m-d',$data['add_time'])?></li></strong>

            </ul>
            <button type="button" onclick="shakeRent(<?=$data['room_id']?>,<?=$data['user_id']?>);" class="btn btn-block btn-lg btn-warning">有意合租</button>
            <div class="room_user col-md-12">
                  <div class="user_email">
                     <span class="glyphicon glyphicon-envelope"></span> <?=$data['email']?>
                  </div>
                  <div class="user_info">
                      <img alt="120x120" style="width: 120px;height: 120px" src="<?=$data['user_picture']?>" class="img-circle" />
                      <div style="float: right;margin-right: 90px;margin-top: 20px;">
                      <span class="glyphicon glyphicon-user"><span style="font-size: 20px">:<?=$data['username']?></span></span>
                      <br><span class="glyphicon glyphicon-star"><span style="font-size: 20px">:<?=ChangeService::actionChangeCredit($data['user_credit'])?></span></span>
                      <br><span class="glyphicon glyphicon-thumbs-up"><span style="font-size: 20px">:<?=ChangeService::actionChangeExpe($data['user_expe'])?></span></span>
                      </div>
                  </div>
                  <div class="promise">
                        --我们承诺--
                      <br ><span style="font-size: 10px;color: #0f0f0f">
                          房源可靠，面向学生，安全保证
                      </span>
                  </div>
                <a href="<?=Url::to(['chat/index'])?>" target="_blank" style="margin-top: 20px;margin-bottom: 20px;" type="button" class="btn btn-block btn-lg btn-info">发送私信</a>
            </div>
        </div>
    </div>
</div>

<style>

    .comment-image{
        height:50px;
        width:50px;
    }
    #baidu-map{
        margin-top: 50px;
        height: 400px;
        border: solid 1px #ccc;

    }
    .promise{
        background: #fff;
        color: #ffa000;
        line-height: 60px;
        font-size: 16px;
        border: solid 1px #ccc;
        text-align: center;
    }
    .user_info{
        border: solid 1px #ccc;
        margin-top: 10px;
    }
    .user_email{
        background: #3d3d3d;
        font-size: 18px;
        height: 30px;
        color: #fea000;
        line-height: 30px;
        font-family: arial;
        border: none;
        margin: 0;
        position: relative;
        padding-left: 110px;
    }
    .room_user{
        background: #fff;
        margin-top: 20px;
        border: solid 1px #ccc;
    }
    .ellipsis {
        width: 100%;
        display: block;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        margin-top: 30px;
    }
    .price{
        font-size: 30px;
        color: #ffa000;
    }
    .tag{
        margin-top: 20px;
        color: #e64d3d;
        border: solid 1px #e64d3d;
    }
    .detail_room{
        padding: 0 25px;
        background: #f5f5f5;
        border-radius: 5px;
        color: #666;
        font-size: 12px;
        margin-bottom: 20px;
        position: relative;
        z-index: 6;
        margin-top: 30px;
    }
    .detail_room li{
        line-height: 31px;
        position: relative;
        border-bottom: solid 1px #fff;
        font-size: 14px;
    }
    .detail_room .icons{
        width: 50px;
        height: 20px;
        background: #ffa000;
        border-radius: 5px;
        color: #fff;
        text-align: center;
        line-height: 20px;
        font-size: 14px;
        display: inline-block;
        margin-left: 10px;
    }
</style>
<script>
    window.onload = function(){
        var point_lng=<?=$data['point_lng']?>;
        var point_lat=<?=$data['point_lat']?>;
        // 百度地图API功能
        var map = new BMap.Map("baidu-map",{minZoom:4,maxZoom:16});
        map.centerAndZoom(new BMap.Point(116.331398,39.897445),14);
        map.enableScrollWheelZoom(true);
        var new_point = new BMap.Point(point_lng,point_lat);

        var marker = new BMap.Marker(new_point);
        map.addOverlay(marker);              // 将标注添加到地图中
        map.panTo(new_point);
    }

    function shakeRent(room_id,user_id) {
       var message= confirm("您确定要合租吗？点击确定意味着您将向该房主公开您的个人信息");
       if(message){
           var formdata=new FormData();
           formdata.append('room_id',room_id);
           formdata.append('user_id',user_id);
           $.ajax(
               {
                   url:'<?=Url::to(['room/shakerent'])?>',
                   type:'POST',
                   cache:false,
                   data:formdata,

                   processData:false,
                   contentType:false,
                   success:function (data) {
                       if(data=='had'){
                           alert('您已经发送，请不要重复点击');
                       }
                       else if(data=='ok'){
                           alert('发送合租成功');
                       }
                   }
               }
           )
       }
    }
    function showcommentres(comments_id) {
        var formdata=new FormData();
        formdata.append('comments_id',comments_id);
        $.ajax(
            {
                url:'<?=Url::to(['room/commentres'])?>',
                type:'POST',
                cache:false,
                data:formdata,
                dataType:'json',
                processData:false,
                contentType:false,
                success:function (data) {
                    if(data){
                        var jsondata=eval(data);
                        $.each(jsondata,function (index,objval){
                            var at_user_id=objval['user_id'];
                            var at_username=objval['username'];
                            var div="<div style='margin-top:20px;margin-left: 20px;font-size: 16px; '>";
                            div+="<img style='height: 40px;width: 40px;border-radius: 50%' src='"+objval['user_picture']+"'/>";
                            div+="<span style='color: #2d64b3'>"+objval['username'];
                            div+="</span>";
                            div+="<span>"+":回复"+objval['at_username']+":"+objval['message'];
                            div+="</span>";
                            div+="<a onclick=addcomres"+"("+at_user_id+",'"+at_username+"',"+comments_id+")"+"; >"+"<span  style='margin-left: 20px;cursor:pointer ;' class='glyphicon glyphicon-edit'>"+"</span>"+"</a>";
                            div+="<span style='float: right;margin-top: 7px;'>"+formatetime(objval['created_at'])+"</span>";
                            div+="</div>";
                            $("#"+comments_id).append(div);
                            $("#btn"+comments_id).button('loading').delay(1000).queue(function() {
                            });
                        })
                    }

                }
            }
        )
    }

    function addcomres(at_user_id,at_username,comments_id) {
        if(<?php if (Yii::$app->user->isGuest){echo '0';} else {echo '1';}?>==0){
            window.location.href ="<?=Url::to(['site/login'])?>";
        }
        $("#res_at_user_id" + comments_id).val(at_user_id);
        $("#res_comments_id" + comments_id).val(comments_id);
        $("#res_comments_con" + comments_id).html("回复" + at_username + ":");
        $("#res-form" + comments_id).show();
    }
    function closediv(comments_id) {
        $("#res-form"+comments_id).hide();
    }

    function formatetime(time) {
        var now= new Date(parseInt(time)*1000);
        var year = now.getFullYear(),
            month = now.getMonth() + 1,
            date = now.getDate(),
            hour = now.getHours(),
            minute = now.getMinutes(),
            second = now.getSeconds();
        timeFormat = year + "-" + month + "-" + date + " " + hour + ":" + minute + ":" + second;

        return timeFormat;
    }
</script>