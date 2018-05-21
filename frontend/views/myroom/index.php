<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\models\Room;
use common\models\RoomWish;
$this->title = '我的合租';


?>
<div class="container" style="margin-top: 50px">
    <div class="row clearfix">
        <div class="col-md-9 column">
            <ul class="breadcrumb">
                <li>
                    <a href="<?=Url::to(['site/index'])?>">首页</a>
                </li>
                <li class="active">
                    我的合租
                </li>
            </ul>
        </div>
        <div class="col-md-3" style="text-align: center">
            <a href="<?=Url::to(['myroom/create'])?>" class="btn btn-primary" >我要发布</a>

        </div>
        <div class="col-md-12">
            <?php
            foreach (Yii::$app->session->getAllFlashes() as $key=>$message){
                echo '<div style="margin-top:50px" class="alert alert-' . $key . '">' . $message . "</div>\n";
            }
            ?>
            <div class="tab-pane active" id="panel-115810">
                <?php
                foreach ($myroom as $row){
                    $roomimagestring=$row['room_images'];
                    $roomimagearray=explode(",",$roomimagestring);
                    ?>
                    <a href="<?=Url::to(['room/detail','room_id'=>$row['room_id']])?>" style="text-decoration: none">
                        <div class="panel panel-primary col-md-10" style="cursor: pointer;margin-top: 20px;border: 0px">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <img style="width: 50px;height: 50px;border-radius: 50%" src="/roomshare/uploads/<?=$roomimagearray[0]?>"><?=$row['room_name']?>
                                    --<?=Room::$ROOM_OVER[$row['is_over']]?>--<?=Room::$ROOM_check[$row['is_check']]?>
                                </h3>
                            </div>
                            <div class="panel-footer">
                                更新时间:<?=date('Y-m-d H:i:s',$row['update_time'])?>
                                有意合租者:<?=RoomWish::GetWishPeople($row['room_id'])?>
                            </div>

                        </div>
                    </a>
                    <div class="col-md-2" style="margin-top: 25px">
                          <a href="javascript:showcheck(<?=$row['room_id']?>)" class="btn btn-info">审核信息</a>
                          <a href="javascript:overroom(<?=$row['room_id']?>)" class="btn btn-warning">结束合租</a>
                          <a href="javascript:deleteroom(<?=$row['room_id']?>)" class="btn btn-danger">删除合租</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="checkinfo" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="text-align: center">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">审核信息</h4>
            </div>
            <div  class="modal-body">
                <h1><span id="checkinfomessage"></span></h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>

    </div>

</div>
<script>
    function showcheck(room_id) {
        var formdata=new FormData();
        formdata.append('room_id',room_id);
        $.ajax({
            url:'<?=Url::to(['myroom/showcheck']) ?>',
            type:'POST',
            cache:false,
            data:formdata,
            processData:false,
            contentType:false,
            success:function (data) {
                $("#checkinfomessage").html(data);
                $("#checkinfo").modal('show');

            }
        })
    }
    function overroom(room_id) {
        var formdata=new FormData();
        formdata.append('room_id',room_id);
        $.ajax({
            url:'<?=Url::to(['myroom/overroom']) ?>',
            type:'POST',
            cache:false,
            data:formdata,
            processData:false,
            contentType:false,
            success:function (data) {
                alert('结贴成功');
                window.location.reload();

            }
        })
    }
    function deleteroom(room_id) {
        var formdata=new FormData();
        formdata.append('room_id',room_id);
        $.ajax({
            url:'<?=Url::to(['myroom/deleteroom']) ?>',
            type:'POST',
            cache:false,
            data:formdata,
            processData:false,
            contentType:false,
            success:function (data) {
                alert('删除成功');
                window.location.reload();

            }
        })
    }
</script>