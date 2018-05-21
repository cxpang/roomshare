<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\RentStory;
use common\models\UserInfo;
$this->title="租房故事";

?>
<div class="container body-back" >
    <div class="row clearfix">
        <div class="col-md-12 column">
            <ul class="breadcrumb">
                <li>
                    <a href="<?=Url::to(['site/index'])?>">首页</a>
                </li>
                <li class="active">
                    故事
                </li>
            </ul>
            <div class="row">
                <?php foreach ($data as $row){?>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img class="img-circle" style="width: 250px;height: 250px;" alt="300x200" src="<?=UserInfo::GetUserImage($row['user_id'])?>" />
                        <div style="text-align: center;margin-top: 20px">作者:<?=$row['username']?></div>
                        <div style="text-align: center">时间:<?=date('Y-m-d',$row['create_at'])?></div>
                        <div style="text-align: center">
                            <?php if($row['is_star']==1){?>
                            <span style="color: green" class="glyphicon glyphicon-star"></span>
                            <?php }?>
                            <?php if($row['is_star']==0){?>
                                <span style="color: green" class="glyphicon glyphicon-star-empty"></span>
                            <?php }?>
                        </div>

                        <div class="caption">
                            <h3>
                                <?=$row['story_name'] ?>
                            </h3>
                            <p>
                               <?=RentStory::getstr($row['story_text'])?>
                            </p>
                            <p>
                                <a class="btn btn-primary" href="<?=Url::to(['rent-story/detail','story_id'=>$row['id']])?>">查看详细</a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php }?>

            </div>
        </div>

    </div>
</div>
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