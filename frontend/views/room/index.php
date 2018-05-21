<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use janisto\timepicker\TimePicker;
use common\models\Room;
use common\models\City;
use common\models\Area;
$this->title = '校园租客';
?>
<div class="container" style="margin-bottom: 200px">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <ul class="breadcrumb">
                <li>
                    <a href="<?=Url::to(['site/index'])?>">首页</a>
                </li>
                <li class="active">
                    校园租客
                </li>
            </ul>



        </div>
    </div>
    <div class="col-md-12" style="border: 1px solid #e4e6eb ;">
        <?php $form = ActiveForm::begin(['method' => "get",'action'=>Url::to(['room/options']),'options' => ['style' => 'margin-top: 10px;margin-bottom:10px;'] ]); ?>

        <div class="col-md-1" style="margin-top: 10px;"><span class="span-content">城市:</span></div>
        <div class="col-md-11 btn-group" style="margin-top: 10px;" data-toggle="buttons">
            <label class="btn btn-default">
                <input type="radio" name="roomcity" value="0" id="btnall"> 全部
            </label>
            <label class="btn btn-default">
                <input type="radio" name="roomcity"  value="110100" id="btnbenjing"> 北京
            </label>
            <label class="btn btn-default">
                <input type="radio" name="roomcity" value="310100" id="btnshanghai"> 上海
            </label>
        </div>

        <div class="col-md-1" style="margin-top: 15px; margin-bottom: 10px;"><span class="span-content">类型:</span></div>
        <div class="col-md-11" style="margin-top: 17px; margin-bottom: 10px;">
            <label class="radio-inline">
                <input type="radio" name="roomtype" id="optionsRadios1" value="1"><span class="label label-warning">合租</span>
            </label>
            <label class="radio-inline">
                <input type="radio" name="roomtype" id="optionsRadios2" value="0"><span class="label label-warning">整租</span>
            </label>
        </div>


        <div class="col-md-1" style="margin-top: 15px;"><span class="span-content">特色:</span></div>
        <div class="col-md-11" style="margin-top: 17px;">
            <label class="radio-inline">
                <input type="radio"  name="commentroom" value="1"> <span class="label label-success">推荐房源</span>
            </label>
            <label class="radio-inline">
                <input type="radio"  name="fineroom" value="1"> <span class="label label-success">精品房源</span>
            </label>
        </div>

        <div class="col-md-1" style="margin-top: 15px; margin-bottom: 10px;"><span class="span-content">价格:</span></div>
        <div class="col-md-11" style="margin-top: 17px; margin-bottom: 10px;">
            <label class="radio-inline">
                <input type="radio" name="roomprice" id="optionsRadios3" value="low" > <span class="label label-warning">1000-2000</span>
            </label>
            <label class="radio-inline">
                <input type="radio" name="roomprice" id="optionsRadios4" value="middle" > <span class="label label-warning">2000-3000</span>
            </label>
            <label class="radio-inline">
                <input type="radio" name="roomprice" id="optionsRadios4"  value="high"> <span class="label label-warning">3000以上</span>
            </label>
        </div>
            <div class="col-md-1"></div>
            <div class="col-md-2" style="margin-top: 17px; margin-bottom: 10px;" >
                <input type="submit" value="提交" class="btn btn-primary">
            </div>
        <?php $form = ActiveForm::end(); ?>
    </div>


    <div class="col-md-12" style="border: 1px solid #e4e6eb;margin-top: 20px">

        <?php
        foreach ($data as $row) {
            ?>
            <a href="<?=Url::to(['room/detail','room_id'=>$row['room_id']])?>">

                <div class="col-md-4 columnroom">
                    <img class="images" src="<?=Room::Delemiteroom($row['room_images'])?>">
                    <div class="itemcontents">
                        <div>
                        <strong><span style="font-size: 20px;color: red"><img src="/roomshare/uploads/yuan.jpg"><?=$row['room_price']?></span></strong>

                            <?php if($row['is_essence']==1){ ?>
                            <span class="glyphicon glyphicon-queen" style="color:green ">精品</span>
                            <?php }?>
                            <?php if($row['is_comment']==1){ ?>
                            <span class="glyphicon glyphicon-thumbs-up" style="color:green ">推荐</span>
                            <?php }?>
                        <span style="float: right"><span class="glyphicon glyphicon-star" style="color:green "></span>评价<?=$row['comment_count']?></span>
                        </div>
                        <div>
                            <span class="glyphicon glyphicon-home"></span>:<?=$row['room_name']?><br />
                            <span class="glyphicon glyphicon-tags"></span>:<span style="font-size: 9px"><?=isset($row['room_content'])?$row['room_content']:'暂无简要信息'?></span>
                            <br />
                            <span class="glyphicon glyphicon-map-marker"></span><?=City::findCity($row['room_city'])."·".Area::findarea($row['room_area'])?>
                            <span style="float: right">
                                <img style="border-radius: 50%;width: 50px;height: 50px;margin-top: -35px;" src="<?=$row['user_picture']?>">
                            </span>
                       </div>

                    </div>


                </div>
            </a>



            <?php
        }
        ?>

    </div>

</div>
<style>
    .columnroom{
        background-color: #ffffff;
        border-bottom: 1px solid #e4e6eb ;
        border-right: 2px solid #e4e6eb;
        cursor: pointer;
        margin-top: 20px;
    }
    .images{
        width: 350px;
        height: 250px;
        border-radius:5%;
    }
    .itemcontents{
        margin-top: 15px;
    }
    a:link,a:visited{color:#444;text-decoration:none;}
    a:hover{color:#ff0000;}
    .span-content{
        font-size: 15px;
        font-family: "Microsoft YaHei";

    }
</style>

