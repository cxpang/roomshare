<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\models\UserInfo;
$this->title = '我的论坛';

?>

<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-12 column">
            <ul class="breadcrumb">
                <li>
                    <a href="<?=Url::to(['site/index'])?>">首页</a>
                </li>
                <li class="active">
                    我的合租
                </li>
            </ul>
        </div>

        <div class="col-md-12">
            <?php if(!empty($datas)){?>
                <?php foreach ($datas as $data){?>
                <a href="<?=Url::to(['rentforum/detail','forum_id'=>$data['forum_id']])?>" style="text-decoration: none">
                    <div class="panel panel-primary col-md-10" style="cursor: pointer;border: 0px;">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <img style="width: 50px;height: 50px;border-radius: 50%" src="<?=$data['user_picture']?>"><?=$data['username']?>
                                最新回复:<?=$data['comment_text']?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <img style="width: 50px;height: 50px;border-radius: 50%" src="<?=UserInfo::GetUserImage(Yii::$app->user->identity->getId())  ;?>"><?php echo Yii::$app->user->identity->username; ?>
                            :<?=$data['forum_name']?>

                        </div>
                        <div class="panel-footer">
                            评论时间:<?=date('Y-m-d H:i:s',$data['created_at'])?>

                        </div>
                    </div>
                </a>
                     <div class="col-md-2" style="margin-top:50px;text-align: center">
                         <a href="javascript:deleteforum(<?=$data['forum_id']?>)" class="btn btn-danger">删除论坛</a>
                     </div>
            <?php }?>
            <?php }?>
        </div>
    </div>
</div>
<script>
    function deleteforum(forum_id) {
        var formdata=new FormData();
        formdata.append('forum_id',forum_id);
        $.ajax({
            url:'<?=Url::to(['myforum/deleteforum']) ?>',
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