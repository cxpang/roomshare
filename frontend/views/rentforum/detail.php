<?php
use common\services\ChangeService;
use  yii\helpers\Html;
use   yii\helpers\Url;

use common\models\UserInfo;
use common\models\User;
use yii\bootstrap\ActiveForm;
$this->title="论坛详细信息";
?>
<div class="container" style="margin-bottom: 50px">
    <div class="row clearfix">
        <div class="col-md-12 column" style="margin-top: 50px">
            <ul class="breadcrumb">
                <li>
                    <a href="<?=Url::to(['site/index'])?>">首页</a>
                </li>
                <li>
                    <a href="<?=Url::to(['rentforum/index'])?>">论坛</a>
                </li>
                <li class="active">
                    论坛详细信息
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="thumbnail">
                        <div>
                            <img alt="300x200" class="img-circle" style="height: 80px;width: 80px" src="<?=$data['user_picture']?>" />

                            <span class="glyphicon glyphicon-user">:<?=$data['username']?></span>
                            <span class="glyphicon glyphicon-star">:<?=ChangeService::actionChangeCredit($data['user_credit'])?></span>
                            <span class="glyphicon glyphicon-thumbs-up">:<?=ChangeService::actionChangeExpe($data['user_expe'])?></span>

                            <span style="float: right;margin-top: 35px;" class="glyphicon glyphicon-time">:<?=date('Y-m-d H:i',$data['created_at'])?></span>
                        </div>
                        <hr />
                        <div class="caption">
                            <div class="col-md-12">
                                <?php if($data['forum_star']==1){?>
                                    <span style="color: red" class="glyphicon glyphicon-star">精品论坛</span>

                                <?php  }?>
                            </div>
                            <h3 style="text-align: center">
                                <?=$data['forum_name']?>
                            </h3>
                            <span style="width: 100%;height: 1000px;border:0;font-size: 20px" readonly>
                                <?=$data['forum_content']?>
                             </span>

                        </div>




                </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#panel-304156" data-toggle="tab"><button class="btn btn-primary">评论信息<span class="badge pull-right"><?=$data['forum_people_counts']?></span></button> </a>

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
                            <?php foreach ($data['comments'] as $row){?>
                                <div class="col-md-12" style="margin-top: 20px;border-top: solid 1px #ccc;">

                                    <div class="col-md-1" style="margin-top: 10px">
                                        <img class="comment-image img-circle" style="width: 50px;height: 50px"   src="<?=UserInfo::GetUserImage($row['user_id'])?>">
                                    </div>
                                    <div class="col-md-11" style="margin-top: 15px">
                                        <div style="font-size: 20px;color:#2d64b3"><?=User::GetUserName($row['user_id'])?></div>
                                        <div style="float: right;font-size: 20px;margin-top: -30px;">
                                            <button data-loading-text="*****" id="btn<?=$row['comment_id']?>" style="color: #2d64b3" class="btn btn-default" onclick="showcommentres(<?=$row['comment_id']?>)"><span class="glyphicon glyphicon-comment"></span>&nbsp;<?=$row['answer_couns']?></button>
                                            <br />
                                            <button style="color: #2d64b3;width: 53px;margin-top: 5px;" onclick="addcomres(<?=$row['user_id']?>,'<?=User::GetUserName($row["user_id"])?>',<?=$row['comment_id']?>)" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span></button>

                                        </div>
                                        <div><?=date('Y-m-d H:i:s',$row['created_at'])?></div>

                                    </div>
                                    <div class="col-md-12" id="<?=$row['comment_id']?>" style="margin-top: 30px;color: #484848;font-size: 18px;margin-bottom: 10px">
                                        <?=$row['comment_text']?>
                                    </div>
                                    <div class="col-md-12" id="res-form<?=$row['comment_id']?>" style="display: none">
                                        <?php $form = ActiveForm::begin(['method' => "post",'action'=>Url::to(['rentforum/addcommres']),'options' => ['style' => 'margin-top: 10px;margin-bottom:10px;'] ]); ?>

                                        <div class="col-md-12 form-group" style="margin-top: 50px;border: solid 1px #ccc;">
                                            <input type="text" name="forum_id" class="form-control" value="<?=$data['forum_id']?>" style="display: none">

                                            <input type="text" id="res_at_user_id<?=$row['comment_id']?>" style="display: none" name="at_user_id" class="form-control">
                                            <input type="text" id="res_comment_id<?=$row['comment_id']?>" value="<?=$row['comment_id']?>" style="display: none" name="comment_id" class="form-control">
                                            <div class="col-md-3" style="margin-top: 23px;font-size: 18px;" id="res_comments_con<?=$row['comment_id']?>"></div>
                                            <div class="col-md-9"  style="margin-top: 20px;">
                                                <input type="text"  name="res_comments_con" class="form-control">
                                            </div>
                                            <div class="col-md-2" style="margin-top: 20px;margin-bottom: 20px;">
                                                <input type="submit" class="btn btn-primary ">
                                            </div>
                                            <div class="col-md-2" style="margin-top: 20px;margin-bottom: 20px;">
                                                <input type="button" onclick="closediv(<?=$row['comment_id']?>);" value="关闭" class="btn btn-danger">
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
                                <?php $form = ActiveForm::begin(['method' => "post",'action'=>Url::to(['rentforum/addcomment']),'options' => ['style' => 'margin-top: 10px;margin-bottom:10px;'] ]); ?>

                                <div class="col-md-12 form-group" style="margin-top: 50px;border: solid 1px #ccc;">
                                    <input type="text" name="forum_id" class="form-control" value="<?=$data['forum_id']?>" style="display: none">
                                    <div class="col-md-2" style="font-size: 18px;margin-top: 24px;">评论内容:</div>
                                    <div class="col-md-10" style="margin-top: 20px;">
                                        <input type="text" name="forumcontent" class="form-control">
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
</div>
</div>
<script>
    function addcomres(at_user_id,at_username,comment_id) {
        if(<?php if (Yii::$app->user->isGuest){echo '0';} else {echo '1';}?>==0){
            window.location.href ="<?=Url::to(['site/login'])?>";
        }
        $("#res_at_user_id" + comment_id).val(at_user_id);
        $("#res_comments_id" + comment_id).val(comment_id);
        $("#res_comments_con" + comment_id).html("回复" + at_username + ":");
        $("#res-form" + comment_id).show();
    }
    function closediv(comment_id) {
        $("#res-form"+comment_id).hide();
    }
    function showcommentres(comment_id) {
        var formdata=new FormData();
        formdata.append('comments_id',comment_id);
        $.ajax(
            {
                url:'<?=Url::to(['rentforum/commentres'])?>',
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
                            div+="<span>"+":回复"+objval['at_username']+":"+objval['ans_text'];
                            div+="</span>";
                            div+="<a onclick=addcomres"+"("+at_user_id+",'"+at_username+"',"+comment_id+")"+"; >"+"<span  style='margin-left: 20px;cursor:pointer ;' class='glyphicon glyphicon-edit'>"+"</span>"+"</a>";
                            div+="<span style='float: right;margin-top: 7px;'>"+formatetime(objval['created_at'])+"</span>";
                            div+="</div>";
                            $("#"+comment_id).append(div);
                            $("#btn"+comment_id).button('loading').delay(1000).queue(function() {
                            });
                        })
                    }

                }
            }
        )
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