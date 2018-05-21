<?php
$this->title="搜索失败";
use yii\helpers\Url;
?>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="alert alert-dismissable alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>
                    啊哦！搜索失败了
                </h4> <strong>对不起!</strong> 系统中并没有您所要找的房源 <a href="<?=Url::to(['site/index'])?>" class="alert-link">返回首页</a>
            </div>
        </div>
    </div>
</div>
