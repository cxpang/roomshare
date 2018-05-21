<?php
$this->title = '常驻内存队列监控';
use yii\helpers\Html;
use yii\helpers\Url;
use common\services\RedisService;
?>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>
                        编号
                    </th>
                    <th>
                        键名
                    </th>
                    <th>
                        操作
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $index =>$key){?>
                <tr class="success">
                    <td>
                        <?=$index?>
                    </td>
                    <td>
                        <?=RedisService::$REDISKEY[$key]?>
                    </td>

                    <td>
                        <div style="margin-bottom: 10px"><button type="button" class="btn btn-default btn-success" onclick="updatekey('<?=$key?>')">更新</button></div>
                        <div><button type="button" class="btn btn-default btn-warning" onclick="deletekey('<?=$key?>')">删除</button></div>
                    </td>
                </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function updatekey(key) {
        var formdata=new FormData();
        formdata.append('key',key);
        $.ajax({
            url:'<?=Url::to(['redis/updatekey']) ?>',
            type:'POST',
            cache:false,
            data:formdata,
            dataType:'json',
            processData:false,
            contentType:false,
            success:function (data) {
                if(data){
                    alert('更新成功');
                    window.location.reload();
                }

            }
        })

    }
    function deletekey(key) {
        var formdata=new FormData();
        formdata.append('key',key);
        $.ajax({
            url:'<?=Url::to(['redis/deletekey']) ?>',
            type:'POST',
            cache:false,
            data:formdata,
            dataType:'json',
            processData:false,
            contentType:false,
            success:function (data) {
                if(data){
                    alert('删除成功');
                    window.location.reload();
                }

            }
        })
    }
</script>
